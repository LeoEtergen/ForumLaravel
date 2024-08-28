<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'vote'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }   
}
