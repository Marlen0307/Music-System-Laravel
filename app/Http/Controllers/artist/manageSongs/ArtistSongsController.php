<?php

namespace App\Http\Controllers\artist\manageSongs;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ArtistSongsController extends Controller
{
    public function showArtistSongs(Request $request){

        //check if the user is artist
        $this->authorize('artist', $request->user());

        //get the artist songs
        $songs = $request->user()->songs()->with(['artists', 'album'])->paginate(6);


        return view("artistViews.songViews.artistSongs", [
            'songs'=>$songs
        ]);
    }
}
