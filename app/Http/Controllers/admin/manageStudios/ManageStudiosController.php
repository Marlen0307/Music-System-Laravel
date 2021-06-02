<?php

namespace App\Http\Controllers\admin\manageStudios;

use App\Http\Controllers\Controller;
use App\Models\Studio;
use Illuminate\Http\Request;

class ManageStudiosController extends Controller
{
    public function showStudios(Request $request){

        //check if the user is admin
        $this->authorize('admin', $request->user());

        //get all Studios in the db
        $studios = Studio::get();

        return view('adminViews.studioViews.manageStudios',[
            'studios' =>$studios
        ]);
    }
}
