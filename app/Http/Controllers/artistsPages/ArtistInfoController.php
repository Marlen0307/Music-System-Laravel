<?php

namespace App\Http\Controllers\artistsPages;

use App\Http\Controllers\Controller;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;

class ArtistInfoController extends Controller
{

    //check if the user is logged in every time artists controller is called
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function showArtistInfo(Request $request, User $artist){
        $users = User::with('roles')->get();
        $artistsAlbums = $artist->albums()->with('artists')->get();
      $artistsSongs =  $artist->songs()->latest()->with('artists')->paginate(5);
        return view("inside.artists.artistInfo", [
            'artist'=>$artist,
            'users' => $users,
            'albums' => $artistsAlbums,
            'songs' => $artistsSongs
        ]);
    }
}
