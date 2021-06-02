<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SongSongwriter extends Model
{
    use HasFactory;

    protected $fillable = [
        'songwriter',
        'song_id',
    ];

    //defining song song_songwriter relationship (one to many)
    public function song(){
        return $this->belongsTo(Song::class);
    }

}
