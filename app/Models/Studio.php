<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'email',
        'mobile',
        'img_src',
        'foundation_date',
    ];

    //defining user_studio relationship (one to many)
    public function users(){
       return $this->hasMany(User::class);
    }

    //defining the genre-studio relationship (many to many)
    public function genres(){
        return $this->belongsToMany(Genre::class);
    }

    //defining studio album relationship (many to many)
    public function albums(){
        return $this->belongsToMany(Album::class);
    }
}
