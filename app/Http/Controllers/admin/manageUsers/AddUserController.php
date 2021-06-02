<?php

namespace App\Http\Controllers\admin\manageUsers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class AddUserController extends Controller
{
    //return the addUser view
    public function addUserForm(Request $request){

        //check if the user is admin
        $this->authorize('admin', $request->user());

        //get the roles and the studios
        $roles = Role::get();
        $studios = Studio::get();


        //return the view with the roles array attached
        return view("adminViews.userViews.addUser",
            ['roles' => $roles],
            ['studios'=>$studios]);
    }

    public function registerUser(Request $request){

        //check if the user is admin
        $this->authorize('admin', $request->user());

        $currentDate = date('Y-m-d');



        //validate the data
        $this->validate($request,[
            'firstname'=>'required|max:80',
            'lastname'=>'required|max:80',
            'address'=>'required|max:255',
            'email'=>'required|email|unique:App\Models\User,email|max:100',
            'birthday'=>"required|date|before_or_equal:$currentDate",
            'mobile'=>'required',
            'photo' => 'required',
            'roles'=>'required',
            'password'=>['required', 'confirmed',
                Password::min (8)
//                    ->mixedCase ()
                    ->letters ()
                    ->numbers ()
//                    ->symbols ()
            ]
        ]);


        //insert the photo into the cloud
        $imgpath = $request->file('photo')->store('images', 's3');

        //check if there is any studio selected for the user
        if ($request->studio !="0"){
            $studioId = $request->studio;
        }else{

            //if no studio was selected we will leave studio_id null
            $studioId = null;
        }

        $user =  User::create([

            //register the user in the db
            'firstname' => $request->firstname,
            'lastname' => $request ->lastname,
            'address' => $request->address,
            'email' => $request->email,
            'birthday' => $request->birthday,
            'img_src'=>$imgpath,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'studio_id' => $studioId
        ]);


        //insert into role_user
        $user->roles()->attach($request->roles);

        //we will let the user know if the insertion was successful
        return back()->with('status', 'User was registered successfully!');

    }



}
