<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentSetting extends Model
{
    protected $fillable = ['type', 'time_limit'];

    public static function timeLimitFor(string $type): int
    {
        return static::where('type', $type)->value('time_limit') ?? 20;
    }
}
