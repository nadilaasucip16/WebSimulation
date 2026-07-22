<?php
// database/migrations/2024_01_01_000002_create_hasil_siswas_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hasil_siswas', function (Blueprint $table) {
            $table->id();
            $table->string('token', 20)->unique()->index();
            $table->foreignId('skenario_id')->nullable()->constrained()->nullOnDelete();
            $table->string('nama_siswa', 100)->default('Anonim');
            $table->json('blueprint_json')->nullable();
            $table->longText('kode_python')->nullable();
            $table->text('prediksi_awal')->nullable();
            $table->json('prediksi_json')->nullable();    // [{step, teks, benar?}]
            $table->text('refleksi')->nullable();
            $table->unsignedSmallInteger('jumlah_step')->default(0);
            $table->unsignedSmallInteger('durasi_detik')->default(0);
            $table->timestamp('selesai_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('hasil_siswas'); }
};
