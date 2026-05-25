<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('course_id')->constrained()->cascadeOnDelete();
            $blueprint->string('title');
            $blueprint->integer('passing_percentage')->default(60);
            $blueprint->integer('max_attempts')->default(3);
            $blueprint->timestamps();
        });

        Schema::create('questions', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('quiz_id')->constrained()->cascadeOnDelete();
            $blueprint->text('question_text');
            $blueprint->integer('points')->default(1);
            $blueprint->timestamps();
        });

        Schema::create('options', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('question_id')->constrained()->cascadeOnDelete();
            $blueprint->text('option_text');
            $blueprint->boolean('is_correct')->default(false);
            $blueprint->timestamps();
        });

        Schema::create('quiz_attempts', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('user_id')->constrained()->cascadeOnDelete();
            $blueprint->foreignId('quiz_id')->constrained()->cascadeOnDelete();
            $blueprint->decimal('score', 5, 2);
            $blueprint->boolean('passed')->default(false);
            $blueprint->integer('attempt_number');
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_attempts');
        Schema::dropIfExists('options');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('quizzes');
    }
};
