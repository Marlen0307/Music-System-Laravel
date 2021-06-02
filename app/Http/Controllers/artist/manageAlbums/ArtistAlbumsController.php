<?php

namespace App\Http\Controllers\artist\manageAlbums;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class ArtistAlbumsController extends Controller
{
    public function showArtistAlbums(Request $request) {

        //check if the user is artist
        $this->authorize('artist', $request->user());

        //get the artist albums
        $albums = $request->user()->albums()->with(['studios', 'artists'])->paginate(5);;


        //return view
        return view("artistViews.albumViews.artistAlbums", [
            'albums' => $albums
        ]);
    }
}
