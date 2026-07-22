<?php
// app/Models/Skenario.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skenario extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 'deskripsi', 'materi',   // 'enkapsulasi' | 'inheritance' | 'keduanya'
        'urutan', 'aktif',
        'blueprint_json',                  // JSON struktur class (untuk pre-fill builder)
        'kode_python',                     // Kode lengkap skenario
        'narasi_tahap',                    // JSON: narasi per langkah trace
    ];

    protected $casts = [
        'aktif'        => 'boolean',
        'blueprint_json' => 'array',
        'narasi_tahap' => 'array',
    ];

    public function hasilSiswas()
    {
        return $this->hasMany(HasilSiswa::class);
    }
}
