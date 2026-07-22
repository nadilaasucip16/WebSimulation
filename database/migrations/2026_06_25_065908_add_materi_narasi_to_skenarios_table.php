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
        Schema::table('skenarios', function (Blueprint $table) {
            if (!Schema::hasColumn('skenarios', 'materi')) {
                $table->enum('materi', ['enkapsulasi', 'inheritance', 'keduanya'])
                      ->default('keduanya')
                      ->after('deskripsi');
            }
            if (!Schema::hasColumn('skenarios', 'narasi_tahap')) {
                $table->json('narasi_tahap')->nullable()->after('kode_python');
            }
        });
    }

    public function down(): void
    {
        Schema::table('skenarios', function (Blueprint $table) {
            $table->dropColumn(['materi', 'narasi_tahap']);
        });
    }
};
