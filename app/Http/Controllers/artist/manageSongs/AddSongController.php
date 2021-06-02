<?php

namespace App\Http\Controllers\artist\manageSongs;

use App\Http\Controllers\Controller;
use App\Models\Song;
use App\Models\SongSongwriter;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class AddSongController extends Controller
{
    public function showAddSongForm(Request $request){
        $this->authorize('artist', $request->user());

        //get artist albums
        $albums = $request->user()->albums()->get();

        //eager load users with roles
        $users = User::with('roles')->get();

        return view("artistViews.songViews.addSong", [
            'albums'=> $albums,
            'users'=> $users
        ]);
    }

    public function addSong(Request $request){
        $this->authorize('artist', $request->user());


        //validate the inputs
        $this->validate($request, [
            'title' => 'required',
            'photo'=> 'required',
            'price'=> 'required',
            'songwriters'=>'required',
        ]);


        //save the image in the s3 bucket
        $imgpath = $request->file('photo')->store('images', 's3');

        //create the song
        $song = new Song;
        $song->title  = $request->title;
        $song->price  = $request->price;
        $song->img_src  = $imgpath;
        if ($request->album != '0'){
            $song->album_id  = $request->album;
        }
        $song->save();

        //we will check if more than one songwriters were checked
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
            $song->artists()->attach($songArtists);
        }else{

            //if there are no collabs we will only insert the user id in the pivot table
            $song->artists()->attach($request->user()->id);
        }

        return back()->with('status', 'Song was added successfully');

    }
}
