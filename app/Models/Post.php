<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'content',
        'type',
        'order',
        'status',
        'published_date',
        'expired_at',
        'author_id',
        'thumbnail',
        'is_hot',
        'slug',
        'path',
        'editor_type',
    ];
}
