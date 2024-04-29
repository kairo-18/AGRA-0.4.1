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
        Schema::create('task_score', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->foreignId('user_id');
            $table->foreignId('task_id');
            $table->foreignId('score_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('task_score', function (Blueprint $table) {
            //
        });
    }
};
