<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'address',
        'email',
        'birthday',
        'img_src',
        'mobile',
        'password',
        'studio_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //definig the user roles relationship(many to many)
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    //defining the user-albums relationship (many to many)
    public function albums(){
        return $this->belongsToMany(Album::class);
    }

    //defining user_studio relationship (one to many)
    public function studio(){
        return $this->belongsTo(Studio::class);
    }

    //defininig artist song relationship (many to many)
    public function songs(){
        return $this->belongsToMany(Song::class);
    }

    //defining the user rate relationship (one to one)
    public  function rate(){
        $this->hasMany(Rate::class);
    }

    //defining user comment relationship(one to one)
    public function comment(){
        return $this->hasMany(User::class);
    }

    //function that returns true if the user is admin
    public function isAdministrator(){
        return $this->roles->where('role', 'admin')->count();
    }

    //function that returns true if the user is artist
    public function isArtist(){
        return $this->roles->where('role', 'artist')->count();
    }

    //function that returns true if the user is songwriter
    public function isSongwriter(){
        return $this->roles->where('role', 'songwriter')->count();
    }

}
