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
        Schema::create('learner_lesson_progress', function (Blueprint $table) {
            $table->id('learner_lesson_progress_id');
            $table->unsignedBigInteger('learner_course_id');
            $table->unsignedBigInteger('learner_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('syllabus_id');
            $table->unsignedBigInteger('lesson_id');
            $table->string('status');
            $table->timestamps();

            $table->foreign('learner_course_id')->references('learner_course_id')->on('learner_course')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('learner_id')->references('learner_id')->on('learner')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('course_id')->references('course_id')->on('course')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('syllabus_id')->references('syllabus_id')->on('syllabus')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('lesson_id')->references('lesson_id')->on('lessons')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learner_lesson_progress');
    }
};
