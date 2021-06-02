<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'genre'
    ];

    //defining the genre-studio relationship (many to many)
    public function studios(){
        return $this->belongsToMany(Studio::class);
    }
}
