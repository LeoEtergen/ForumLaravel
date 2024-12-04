<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'category_id',
        'user_id',
    ];

    public function post()
    {
        return $this->morphOne(Post::class, 'postable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        // Especifica a tabela pivot 'topic_tags'
        return $this->belongsToMany(Tag::class, 'topic_tags', 'topic_id', 'tag_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
