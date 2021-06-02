<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'album_id',
        'img_src',
        'price',
    ];

    //defining the song album relationship (one to many)
    public function album(){
        return $this->belongsTo(Album::class);
    }

    //defininig artist song relationship (many to many)
    public function artists(){
        return $this->belongsToMany(User::class);
    }

    //defining song song_songwriter relationship (one to many)
    public function songwriters(){
        return $this->hasMany(SongSongwriter::class);
    }
}
