<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //a logged in user can not log in again without logging out
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    //display the login form
    public function showLoginForm(){
        return view("auth.logIn");
    }

    //log in the system
    public function logIn(Request $request){

        //validate the data
            $this->validate($request,[
                'email'=>'required|email',
                'password'=>'required'
            ]);

            //check if the credentials are correct
            if(!auth()->attempt($request->only('email','password'),$request->remember)){

                //redirect the user back if the credentials are wrong with an error message
               return redirect()->back()->with('status', 'Invalid credentials');
            }

            //redirect the user to the home of our application if the credentials are correct
            return redirect()->route('artists');
    }

}
