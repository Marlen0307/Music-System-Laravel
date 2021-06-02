<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
      'img_src',
      'user_id'
    ];

    //defining user-image relationship (one to one)
    public function user(){
        return $this->belongsTo(User::class);
    }

    //defining studio image relationship (one to one)
    public function studio(){
        return $this->belongsTo(Studio::class);
    }
}
