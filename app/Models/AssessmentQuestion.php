<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentQuestion extends Model
{
    protected $fillable = [
        'type', 'number', 'question',
        'option_a', 'option_b', 'option_c', 'option_d',
        'answer',
    ];
}
