<?php

namespace App\Http\Controllers\artist\manageAlbums;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Http\Request;

class AddAlbumController extends Controller
{
    public function showAddAlbumForm(Request $request){

        //check if the user is artist
        $this->authorize('artist', $request->user());

        $studios = Studio::get();
        $users = User::with('roles')->get();


        return view("artistViews.albumViews.addAlbum", [
            'users' =>$users,
            'studios' => $studios
        ]);
    }

    public function addAlbum(Request $request){

        //check if the user is artist
        $this->authorize('artist', $request->user());

        //get the current date
        $currentDate = date('Y-m-d');

        //validate the inputs
        $this->validate($request, [
            'title' => 'required',
            'photo'=> 'required',
            'release_date'=>"required|date|before_or_equal:$currentDate",
            'studios'=>'required',
            'price'=>'required',
        ]);

        //save the image in the s3 bucket
        $imgpath = $request->file('photo')->store('images', 's3');

        //create the album
        $album = Album::create([
           'title'=>$request->title,
            'price'=>$request->price,
           'release_date'=>$request->release_date,
           'img_src'=>$imgpath
        ]);

        //insert into studio album
        $album->studios()->attach($request->studios);

        //insert into user album
        if ($request->users){

            //if collaborators were selected we will insert them
            $album->artists()->attach($request->users);
            $album->artists()->attach($request->user()->id);
        }else{

            //otherwise we will only insert the artist
            $album->artists()->attach($request->user()->id);
        }

        //let the user know
        return back()->with('status', 'Album was addedd successfully');
    }
}
