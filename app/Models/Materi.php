<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $fillable = ['title', 'content', 'video_path', 'color', 'sort_order'];
}
