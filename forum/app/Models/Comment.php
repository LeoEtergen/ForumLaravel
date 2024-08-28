<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Post
{
    protected $fillable = [
        'content'
    ];

    public function topic()
    {
        return $this->belongsToMany(Topic::class);
    }
}
