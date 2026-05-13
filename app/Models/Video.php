<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    protected $fillable = [
        'title',
        'video_path',
        'created_by',
        'category_id',
        'is_trending',
        'rating',
        'description',
        'thumbnail',
        'duration',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
