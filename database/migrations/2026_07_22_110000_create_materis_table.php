<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materis', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->text('content')->nullable();
            $table->string('video_path')->nullable();
            $table->string('color', 20)->default('green');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materis');
    }
};
