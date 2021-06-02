<?php

namespace App\Http\Controllers\albumsPages;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Comment;
use Illuminate\Http\Request;

class AlbumInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function showAlbumInfo(Album $album){
        $albumSongs = $album->songs()->with(['artists', 'songwriters'])->paginate(5);
        $albumArtist = $album->artists()->get();
        $albumStudios = $album->studios()->get();
        $comments = $album->comments()->latest()->with('user')->paginate(5);
        $avgRate = $album->rates()->avg('rate');
        return view("inside.albums.albumInfo", [
            'album' => $album,
            'songs' => $albumSongs,
            'studios' => $albumStudios,
            'artists' => $albumArtist,
            'comments' => $comments,
            'rate' => $avgRate
        ]);
    }
}
