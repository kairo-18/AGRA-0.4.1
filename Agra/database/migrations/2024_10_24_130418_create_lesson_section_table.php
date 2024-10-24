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
        Schema::create('lesson_section', function (Blueprint $table) {
            //
            $table->id();
            $table->foreignId('lesson_id')->nullable();
            $table->foreignId('section_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('lesson_section', function (Blueprint $table) {
            //
        });
    }
};
