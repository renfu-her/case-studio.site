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
            $table->string('mail_class')->comment('郵件類別名稱');
            $table->string('to_email')->comment('收件人郵箱');
            $table->string('subject')->comment('郵件主題');
            $table->text('error_message')->nullable()->comment('錯誤訊息');
            $table->unsignedTinyInteger('attempts')->default(0)->comment('嘗試次數');
            $table->timestamp('last_attempt_at')->nullable()->comment('最後嘗試時間');
            $table->boolean('is_sent')->default(false)->comment('是否已發送');
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
