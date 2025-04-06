<?php

namespace App\Console\Commands;

use App\Models\SendMailQueue;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ProcessMailQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:process-queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '處理郵件發送隊列';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $maxAttempts = 3; // 最大重試次數

        SendMailQueue::where('is_sent', false)
            ->where('attempts', '<', $maxAttempts)
            ->chunk(10, function ($queues) use ($maxAttempts) {
                foreach ($queues as $queue) {
                    try {
                        // 實例化郵件類
                        $mailableClass = $queue->mail_class;
                        $mailable = new $mailableClass($queue->mailable);

                        // 發送郵件
                        Mail::to($queue->to_email)->send($mailable);

                        // 標記為已發送
                        $queue->markAsSent();
                        
                        $this->info("成功發送郵件 ID: {$queue->id} 到 {$queue->to_email}");
                        
                    } catch (\Exception $e) {
                        // 記錄錯誤並增加嘗試次數
                        $queue->incrementAttempts();
                        $queue->recordError($e->getMessage());
                        
                        $this->error("發送郵件失敗 ID: {$queue->id}, 錯誤: {$e->getMessage()}");

                        // 如果達到最大重試次數，記錄最終失敗
                        if ($queue->attempts >= $maxAttempts) {
                            $this->error("郵件 ID: {$queue->id} 已達最大重試次數");
                        }
                    }
                }
            });

        $this->info('郵件隊列處理完成');
    }
}
