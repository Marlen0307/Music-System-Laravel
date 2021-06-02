<?php

namespace App\Http\Controllers\admin\manageStudios;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function GuzzleHttp\Promise\all;

class UpdateStudioController extends Controller
{
    public function showUpdateStudioForm(Studio $studio, Request $request){

        //check if the user is admin
        $this->authorize('admin', $request->user());

        $genres = Genre::get();

        $selectedGenres = $studio->genres()->get();

        //return updateStudio view
        return view("adminViews.studioViews.updateStudio", [
            'studio' => $studio,
            'genres' => $genres,
            'selectedGenres' => $selectedGenres
        ]);
    }

    public function updateStudio(Request $request, Studio $studio){

        //check if the user is admin
        $this->authorize('admin', $request->user());

        //check if the email is changed
        if ($studio->email != $request->email){

            //if it is changed we will have the *unique* check in the email validation rules
            $emailRules = 'required|email|unique:App\Models\Studio,email';
        }else{

            //else we will not check if the email is unique
            $emailRules = 'required|email';
        }
        $currentDate = date('Y-m-d');

        //validate the inputs
        $this->validate($request, [
            'name' => 'required',
            'location' => 'required',
            'email' => $emailRules,
            'found_date'=>"required|date|before_or_equal:$currentDate",
            'mobile'=>'required',
            'genres'=>'required'
            ]);

        //check if there is any photo submitted
         if($request->photo){

             //if it is we will delete the old one in the s3 disk and save the new one
             Storage::disk('s3')->delete($studio->img_src);
             $newImagePath = $request->file('photo')->store('images', 's3');
         }

         //update the studio
         $studio->name =  $request->name;
         if (isset($newImagePath)){
             $studio->img_src =  $newImagePath;
         }
         $studio->location =  $request->location;
         $studio->email =  $request->email;
         $studio->mobile =  $request->mobile;
         $studio->save();

         //update the genre_studio table
        $studio->genres()->sync($request->genres);

        //redirect the user back with success status
        return back()->with("status", "Studio was updated successfully");

    }
}
