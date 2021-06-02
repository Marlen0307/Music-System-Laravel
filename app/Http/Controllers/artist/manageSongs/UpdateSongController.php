<?php

namespace App\Http\Controllers\artist\manageSongs;

use App\Http\Controllers\Controller;
use App\Models\Song;
use App\Models\SongSongwriter;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateSongController extends Controller
{
    public function showUpdateForm(Request $request, Song $song){
        $this->authorize('artist', $request->user());

        //get artist albums
        $albums = $request->user()->albums()->get();

        //eager load users with roles
        $users = User::with('roles')->get();

        $selectedArtist = $song->artists()->get();
        $selectedSongwriters = SongSongwriter::where('song_id', $song->id)->get();

        return view("artistViews.songViews.updateSong",[
            'song' => $song,
            'albums'=> $albums,
            'users'=> $users,
            'selectedArtists' => $selectedArtist,
            'selectedSongwriters'=> $selectedSongwriters
        ]);
    }

    public function updateSong(Song $song, Request $request){

        $this->authorize('artist', $request->user());

        //validate the inputs
        $this->validate($request, [
            'title' => 'required',
            'price'=> 'required',
            'songwriters'=>'required',
        ]);

        //check if there is any photo submitted
        if($request->photo){

            //if it is we will delete the old one in the s3 disk and save the new one
            Storage::disk('s3')->delete($song->img_src);
            $newImagePath = $request->file('photo')->store('images', 's3');
        }

        $song->title  = $request->title;
        $song->price  = $request->price;
        if (isset($newImagePath)){
            $song->img_src  = $newImagePath;
        }
        if ($request->album != '0'){
            $song->album_id  = $request->album;
        }
        $song->save();

        //delete the present songwriters
        $song->songwriters()->delete();

        if (count($request->songwriters)>1){

            //if so we will create a new instance of SongSongwriter Model for everyone of them
            foreach ($request->songwriters as $songwriter){
                $songSongwriter = new SongSongwriter([
                    'songwriter' => $songwriter,
                    'song_id' => $song->id
                ]);

                //save the related model
                $song->songwriters()->save($songSongwriter);
            }
        }else{

            //we will come here if there was selected only one songwriter
            $songSongwriter = new SongSongwriter([
                'songwriter' => $request->songwriters[0],
                'song_id' => $song->id
            ]);

            $song->songwriters()->save($songSongwriter);
        }

        //check if there are any collaborations
        if ($request->artists){

            //if there are we will insert them along with the user id in the song user table
            $songArtists = $request->artists;
            array_push($songArtists, $request->user()->id);
            $song->artists()->sync($songArtists);
        }else{

            //if there are no collabs we will only insert the user id in the pivot table
            $song->artists()->sync($request->user()->id);
        }

        return back()->with('status', 'Song was updated successfully');

    }
}
