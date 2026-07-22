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
        Schema::table('learning_progress', function (Blueprint $table) {
            // Pertemuan 2 – Inheritance
            $table->integer('p2_fase1')->default(0)->after('fase5');
            $table->integer('p2_fase2')->default(0)->after('p2_fase1');
            $table->integer('p2_fase3')->default(0)->after('p2_fase2');
            $table->integer('p2_fase4')->default(0)->after('p2_fase3');
            $table->integer('p2_fase5')->default(0)->after('p2_fase4');

            // Pertemuan 3 – Proyek Akhir (Enkapsulasi + Inheritance)
            $table->integer('p3_fase1')->default(0)->after('p2_fase5');
            $table->integer('p3_fase2')->default(0)->after('p3_fase1');
            $table->integer('p3_fase3')->default(0)->after('p3_fase2');
            $table->integer('p3_fase4')->default(0)->after('p3_fase3');
            $table->integer('p3_fase5')->default(0)->after('p3_fase4');
        });
    }

    public function down(): void
    {
        Schema::table('learning_progress', function (Blueprint $table) {
            $table->dropColumn([
                'p2_fase1','p2_fase2','p2_fase3','p2_fase4','p2_fase5',
                'p3_fase1','p3_fase2','p3_fase3','p3_fase4','p3_fase5',
            ]);
        });
    }
};
