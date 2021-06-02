<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
        'comment',
      'album_id',
    ];

    //defining user comment relationship(one to one)
    public function user(){
        return $this->belongsTo(User::class);
    }

    //defining the album comment relationship
    public function album(){
        return $this->belongsTo(Album::class);
    }
}
