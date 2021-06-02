<?php

namespace App\Http\Controllers\artist\manageAlbums;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteAlbumController extends Controller
{
    public function deleteAlbum(Album $album, Request $request){

        //check if the user is artist
        $this->authorize('artist', $request->user());

        //delete the album image in the s3 drive
        Storage::disk('s3')->delete($album->img_src);

        //delete the album and then redirect back
        $album->delete();
        return back();
    }
}
