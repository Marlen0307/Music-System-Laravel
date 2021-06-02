<?php

namespace App\Http\Controllers\admin\manageStudios;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AddStudioController extends Controller
{
    public function showAddStudioForm(Request $request){

        //check if the user is admin
        $this->authorize('admin', $request->user());

        //get all genres
        $genres = Genre::get();

        //return the addStudio view
        return view("adminViews.studioViews.addStudio",[
            'genres' =>$genres
        ]);
    }

    public function registerStudio(Request $request){

        //check if the user is admin
        $this->authorize('admin', $request->user());

        //get the current date
        $currentDate = date('Y-m-d');


        $this->validate($request, [
            'name' => 'required',
            'photo'=> 'required|image',
            'email'=> 'required|email|unique:App\Models\Studio,email',
            'location' => 'required',
            'found_date'=>"required|date|before_or_equal:$currentDate",
            'mobile'=>'required',
            'genres'=>'required'
        ]);

        //store the studio image in the s3 storage and store the path in the variable
        $imgpath = $request->file('photo')->store('images', 's3');


        //insert the studio in the studios table
        $studio = Studio::create([
           'name' => $request->name,
           'location'=> $request->location,
           'img_src' => $imgpath,
           'email' => $request->email,
           'foundation_date' => $request->found_date,
            'mobile' => $request->mobile
        ]);

        //insert into genre_studio
        $studio->genres()->attach($request->genres);

        return back()->with("status", "Studio was registered successfully");


    }
}
