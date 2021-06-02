<?php

namespace App\Http\Controllers\artistsPages;

use App\Http\Controllers\Controller;
use App\Models\User;

class ArtistsController extends Controller
{
    //check if the user is logged in every time artists controller is called
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function artistsPage(){
        $users = User::with(['roles', 'studio'])->get();
        return view("inside.artists.artists", [
            'users' => $users
        ]);
    }
}
