<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('course__students', function (Blueprint $table) {
            $table->foreign('course_id')->references('id')->on('courses')->cascadeOnDelete();
            $table->foreign('student_id')->references('id')->on('students')->cascadeOnDelete();
            $table->unique(['course_id', 'student_id']);
        });
    }

    public function down(): void
    {
        Schema::table('course__students', function (Blueprint $table) {
            $table->dropUnique(['course_id', 'student_id']);
            $table->dropForeign(['course_id']);
            $table->dropForeign(['student_id']);
        });
    }
};
