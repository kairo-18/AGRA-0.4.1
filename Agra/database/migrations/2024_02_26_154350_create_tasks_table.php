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
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('lesson_id');
            $table->foreignId('course_id');

            $table->string('TaskName');
            $table->string('Description');
            $table->text('TaskCodeTemplate');
            $table->text('TaskAnswerKeys');
            $table->text('TaskMaxScore');
            $table->text('TaskMaxTime');
            $table->text('TaskDifficulty');

            $table->dateTime('DateGiven');
            $table->dateTime('Deadline');

            $table->string('TaskStatus')->default('Unfinished');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
