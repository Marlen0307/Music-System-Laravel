<?php

namespace App\Http\Controllers\artist\manageSongs;

use App\Http\Controllers\Controller;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteSongController extends Controller
{
    public function deleteSong(Request $request, Song $song){
        $this->authorize('artist', $request->user());

        Storage::disk('s3')->delete($song->img_src);

        $song->delete();

        return back();
    }
}
