<?php

namespace App\Http\Controllers\albumsPages;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumsController extends Controller
{
    //check if the user is logged in every time albums controller is called
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function showAlbums(){
        $albums = Album::with('artists', 'studios')->get();

        return view("inside.albums.albums", [
            'albums' => $albums
        ]);
    }
}
