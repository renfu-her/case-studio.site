<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('send_mail_queues', function (Blueprint $table) {
            $table->id();
            $table->morphs('mailable');  // 關聯到其他模型（如 ContactUs）
            $table->string('mail_class'); // 郵件類別名稱
            $table->string('to_email');   // 收件人郵箱
            $table->string('subject');    // 郵件主題
            $table->text('error_message')->nullable(); // 錯誤訊息
            $table->integer('attempts')->default(0);   // 嘗試次數
            $table->timestamp('last_attempt_at')->nullable(); // 最後嘗試時間
            $table->boolean('is_sent')->default(false); // 是否已發送
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('send_mail_queues');
    }
};
