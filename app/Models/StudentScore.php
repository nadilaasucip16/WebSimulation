<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentScore extends Model
{
    protected $fillable = [
        'user_id',
        'pretest',
        'posttest',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
