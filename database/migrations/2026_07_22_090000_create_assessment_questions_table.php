<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessment_questions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['pretest', 'posttest']);
            $table->unsignedTinyInteger('number');
            $table->text('question');
            $table->text('option_a');
            $table->text('option_b');
            $table->text('option_c');
            $table->text('option_d');
            $table->char('answer', 1); // A, B, C, or D
            $table->timestamps();
            $table->unique(['type', 'number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessment_questions');
    }
};
