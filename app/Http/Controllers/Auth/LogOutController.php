<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LogOutController extends Controller
{

    //log the user out
    public function logOut(){
        auth()->logout();

        return redirect()->route("home");
    }
}
