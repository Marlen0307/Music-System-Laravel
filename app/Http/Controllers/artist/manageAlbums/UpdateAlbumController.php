<?php

namespace App\Http\Controllers\artist\manageAlbums;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateAlbumController extends Controller
{
    public function showUpdateForm(Album $album, Request $request){

        //check if the user is artist
        $this->authorize('artist', $request->user());

        $studios = Studio::get();
        $users = User::with('roles')->get();
        $selectedStudios = $album->studios()->get();
        $selectedUsers = $album->artists()->get();
        return view("artistViews.albumViews.updateAlbum", [
            'studios'=>$studios,
            'users'=>$users,
            'album'=>$album,
            'selectedStudios'=>$selectedStudios,
            'selectedUsers'=>$selectedUsers
        ]);
    }

    public function updateAlbum(Album $album, Request $request){

        //check if the user is artist
        $this->authorize('artist', $request->user());

          //get the current date
        $currentDate = date('Y-m-d');

        //validate the inputs
        $this->validate($request, [
            'title' => 'required',
            'release_date'=>"required|date|before_or_equal:$currentDate",
            'studios'=>'required',
            'price'=>'required',
            ]);

        //check if there is any photo submitted
        if($request->photo){

            //if it is we will delete the old one in the s3 disk and save the new one
            Storage::disk('s3')->delete($album->img_src);
            $newImagePath = $request->file('photo')->store('images', 's3');
        }

        //update the album
        $album->title = $request->title;

        //this will only be set if any image was submitted
        if (isset($newImagePath)){
            $album->img_src = $newImagePath;
        }
        $album->release_date = $request->release_date;
        $album->price = $request->price;

        $album->save();

        //updatet the album stusio table
        $album->studios()->sync($request->studios);

        //check if any collaboration was submitted
        if($request->users){

            //if there are we will convert the user id to string and push it to artist array
            $artists = $request->users;
            array_push($artists, strval($request->user()->id));

            //update the album user table
            $album->artists()->sync($artists);
        }else{

            //if we come here that means that the album has no collaboration
            $album->artists()->sync($request->user()->id);
        }

        return back()->with('status', 'Album updated successfully');



    }
}
