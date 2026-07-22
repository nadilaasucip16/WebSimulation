<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningProgress extends Model
{
    protected $table = 'learning_progress';

    protected $fillable = [
        'user_id',
        // Pertemuan 1 – Enkapsulasi
        'fase1','fase2','fase3','fase4','fase5',
        // Pertemuan 2 – Inheritance
        'p2_fase1','p2_fase2','p2_fase3','p2_fase4','p2_fase5',
        // Pertemuan 3 – Proyek Akhir
        'p3_fase1','p3_fase2','p3_fase3','p3_fase4','p3_fase5',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function score()
    {
        return $this->hasOne(StudentScore::class, 'user_id', 'user_id');
    }
}
