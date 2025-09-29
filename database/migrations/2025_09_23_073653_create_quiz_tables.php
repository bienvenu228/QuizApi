<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Table Phases
        Schema::create('phases', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('level');
            $table->integer('points_weight')->default(1);
            $table->timestamps();
        });

        // Table Themes
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('phase_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->timestamps();
        });

        // Table Questions
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('theme_id')->constrained()->onDelete('cascade');
            $table->text('content');
            $table->timestamps();
        });

        // Table Choices
        Schema::create('choices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->string('content');
            $table->boolean('is_correct')->default(false);
            $table->timestamps();
        });

        // Table User Answers
        Schema::create('user_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->foreignId('choice_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['user_id', 'question_id']); // pas de double réponse
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_answers');
        Schema::dropIfExists('choices');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('themes');
        Schema::dropIfExists('phases');
    }
};