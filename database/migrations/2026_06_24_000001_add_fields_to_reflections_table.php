<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reflections', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id')->constrained()->onDelete('cascade');
            $table->string('jawaban', 1)->nullable()->after('user_id');
            $table->text('refleksi')->nullable()->after('jawaban');
        });
    }

    public function down(): void
    {
        Schema::table('reflections', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'jawaban', 'refleksi']);
        });
    }
};
