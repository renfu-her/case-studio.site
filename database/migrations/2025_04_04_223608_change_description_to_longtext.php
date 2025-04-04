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
        Schema::table('about_us', function (Blueprint $table) {
            $table->longText('content')->change();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->longText('description')->change();
        });

        Schema::table('slides', function (Blueprint $table) {
            $table->longText('description')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_us', function (Blueprint $table) {
            $table->text('content')->change();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->text('description')->change();
        });

        Schema::table('slides', function (Blueprint $table) {
            $table->text('description')->change();
        });
    }
};
