<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description'
    ];

    protected $primaryKey = 'id';  // Chave primária correta

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
