<?php

namespace App\Http\Controllers\studiosPages;

use App\Http\Controllers\Controller;
use App\Models\Studio;
use Illuminate\Http\Request;

class StudiosController extends Controller
{
    //check if the user is logged in every time studios controller is called
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function studiosPage(){
       $studios =  Studio::get();

        return view("inside.studios.studiosPage",[
            'studios' => $studios
        ]);
    }


}
