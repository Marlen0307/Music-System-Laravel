<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'release_date',
        'img_src'
    ];

    //defining the user-albums relationship (many to many)
    public function artists(){
        return $this->belongsToMany(User::class);
    }

    public function songs(){
        return $this->hasMany(Song::class);
    }

    //defining studio album relationship (many to many)
    public function studios(){
        return $this->belongsToMany(Studio::class);
    }

    //defining the album rate relationship (one to many)
    public function rates(){
        return $this->hasMany(Rate::class);
    }

    //defining user comment relationship(one to one)
    public function comments(){
        return $this->hasMany(Comment::class);
    }

}
