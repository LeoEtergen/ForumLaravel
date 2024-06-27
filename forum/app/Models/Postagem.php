<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Postagem extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'conteudo',
        'user_id',
    ];

    protected $table = 'postagens';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
