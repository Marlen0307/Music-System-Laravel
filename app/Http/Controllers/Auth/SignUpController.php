<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use function Symfony\Component\String\u;

class SignUpController extends Controller
{
    //a logged in user can not register
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    //function to return the signUp Form
    public function signUpForm(){
        return view("auth.signUp");
    }

    //function that handles the submission of the form
    public function registerUser(Request $request){

        $currentDate = date('Y-m-d');

        //validate the data
        $this->validate($request,[
           'firstname'=>'required|max:80',
            'lastname'=>'required|max:80',
            'address'=>'required|max:255',
            'email'=>'required|email|unique:App\Models\User,email|max:100',
            'birthday'=>"required|date|before_or_equal:$currentDate",
            'mobile'=>'required',
            'password'=>['required', 'confirmed',
                Password::min (8)
//                    ->mixedCase ()
                    ->letters ()
                    ->numbers ()
//                    ->symbols ()
            ]
        ]);

        //check if the user submitted his photo
        if($request->photo){

            //store the images in the aws s3 storage
            $imgpath = $request->file('photo')->store('images', 's3');

        }else{

            //if no photo was inserted we will leave the img_src on null
            $imgpath = null;
        }

        //wrap the statement in a variable so we can check if the insertion was successful
        $user =  User::create([

            //register the user in the db
            'firstname' => $request->firstname,
            'lastname' => $request ->lastname,
            'address' => $request->address,
            'email' => $request->email,
            'birthday' => $request->birthday,
            'img_src' => $imgpath,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password)
        ]);




           //insert into role_user
            $user->roles()->attach(2);

               //we will let the user know if the insertion was successful
               return back()->with('status', 'You were signed up successfully! You can now log in!');



        }

}
