<?php
// app/Models/HasilSiswa.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasilSiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'token', 'skenario_id', 'nama_siswa',
        'blueprint_json', 'kode_python',
        'prediksi_awal', 'prediksi_json', 'refleksi',
        'jumlah_step', 'durasi_detik', 'selesai_at',
    ];

    protected $casts = [
        'blueprint_json' => 'array',
        'prediksi_json'  => 'array',
        'selesai_at'     => 'datetime',
    ];

    public function skenario()
    {
        return $this->belongsTo(Skenario::class);
    }
}
