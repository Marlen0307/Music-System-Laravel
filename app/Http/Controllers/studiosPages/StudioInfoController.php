<?php

namespace App\Http\Controllers\studiosPages;

use App\Http\Controllers\Controller;
use App\Models\Studio;


class StudioInfoController extends Controller
{
    //check if the user is logged in every time studios controller is called
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function showStudioInfo(Studio $studio){
        $studioGenres = $studio->genres()->get();
        $studioActors = $studio->users()->with('roles')->paginate(10);
        $studioAlbums = $studio->albums()->paginate(10);
        return view("inside.studios.studioInfo", [
            'studio'=>$studio,
            'genres' => $studioGenres,
            'users' => $studioActors,
            'albums' => $studioAlbums
        ]);
    }
}
