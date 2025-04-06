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
        Schema::table('send_mail_queues', function (Blueprint $table) {
            // 修改欄位註釋
            $table->string('mail_class')->comment('郵件類別名稱')->change();
            $table->string('to_email')->comment('收件人郵箱')->change();
            $table->string('subject')->comment('郵件主題')->change();
            $table->text('error_message')->nullable()->comment('錯誤訊息')->change();
            $table->unsignedTinyInteger('attempts')->default(0)->comment('嘗試次數')->change();
            $table->timestamp('last_attempt_at')->nullable()->comment('最後嘗試時間')->change();
            $table->boolean('is_sent')->default(false)->comment('是否已發送')->change();

            // 檢查並添加欄位
            if (!Schema::hasColumn('send_mail_queues', 'mailable_type')) {
                $table->string('mailable_type')->comment('關聯模型類型');
            }
            if (!Schema::hasColumn('send_mail_queues', 'mailable_id')) {
                $table->unsignedBigInteger('mailable_id')->comment('關聯模型 ID');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('send_mail_queues', function (Blueprint $table) {
            // 移除欄位
            if (Schema::hasColumn('send_mail_queues', 'mailable_type')) {
                $table->dropColumn('mailable_type');
            }
            if (Schema::hasColumn('send_mail_queues', 'mailable_id')) {
                $table->dropColumn('mailable_id');
            }

            // 移除註釋
            $table->string('mail_class')->change();
            $table->string('to_email')->change();
            $table->string('subject')->change();
            $table->text('error_message')->nullable()->change();
            $table->unsignedTinyInteger('attempts')->default(0)->change();
            $table->timestamp('last_attempt_at')->nullable()->change();
            $table->boolean('is_sent')->default(false)->change();
        });
    }
};
