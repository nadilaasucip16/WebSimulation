<?php
// database/migrations/2024_01_01_000001_create_skenarios_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('skenarios', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->enum('materi', ['enkapsulasi', 'inheritance', 'keduanya'])->default('keduanya');
            $table->unsignedTinyInteger('urutan')->default(0);
            $table->boolean('aktif')->default(true);
            $table->json('blueprint_json')->nullable();  // struktur class untuk pre-fill
            $table->longText('kode_python')->nullable(); // kode lengkap
            $table->json('narasi_tahap')->nullable();    // narasi per langkah
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('skenarios'); }
};
