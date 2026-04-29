<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //
    protected $fillable = [
        'title',
        'video_path',
        'created_by',
        'is_trending',
        'rating',
        'description',
        'thumbnail',
        'duration'
    ];
}
