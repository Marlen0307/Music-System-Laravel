<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rate',
        'album_id'
    ];

    //defining the rate album relationship (one to many)
    public function albums(){
        return $this->belongsTo(Album::class);
    }

    //defining the rate user relationship (one to one)
    public function user(){
        return $this->belongsTo(User::class);
    }
}
