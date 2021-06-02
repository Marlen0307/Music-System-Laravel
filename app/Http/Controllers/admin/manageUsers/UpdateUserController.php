<?php

namespace App\Http\Controllers\admin\manageUsers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateUserController extends Controller
{
    public function updateForm(User $user, Request $request){

        //check if the user is admin
        $this->authorize('admin', $request->user());

        //get all Studios
        $studios = Studio::get();

        //get all the roles
        $roles = Role::get();

        $selectedRoles = $user->roles()->get();


        //return the view
        return view("adminViews.userViews.updateUser", [
            'user' => $user,
            'roles' => $roles,
            'studios' => $studios,
            'selectedRoles' => $selectedRoles
        ]);
    }

    public function updateUser(User $user, Request $request){

        //check if the user is admin
        $this->authorize('admin', $request->user());

        //get the curent date
        $currentDate = date('Y-m-d');

        //we will check if the email is changed
        if($user->email != $request->email){

            //if the email is changed email will need to be unique in the users tables
            $emailRules = 'required|email|unique:App\Models\User,email|max:100';
        }else{

            //if the email is not changed we shouldn't check if it is unique because it would not pass the validation
            $emailRules = 'required|email|max:100';
        }

        //validate the inputs
        $this->validate($request, [
            'firstname'=>'required|max:80',
            'lastname'=>'required|max:80',
            'roles' => 'required',
            'address'=>'required|max:255',
            'email'=>$emailRules,
            'birthday'=>"required|date|before_or_equal:$currentDate",
            'mobile'=>'required',
        ]);

        if ($request->photo){

            //if it is we will delete the old one in the s3 disk and save the new one
            Storage::disk('s3')->delete($user->img_src);
            $newImagePath = $request->file('photo')->store('images', 's3');
        }

        //update the user
        $user->firstname =  $request->firstname;
        $user->lastname =  $request->lastname;
        if (isset($newImagePath)){
            $user->img_src =  $newImagePath;
        }
        $user->address =  $request->address;
        $user->email =  $request->email;
        $user->birthday = $request->birthday;
        $user->mobile =  $request->mobile;
        if ($request->studio != '0'){
            $user->studio_id =  $request->studio;
        }
        if ($request->studio == '0'){
            $user->stuido_id = null;
        }
        $user->save();

        //update user roles
        $user->roles()->sync($request->roles);

        return back()->with('status', 'User updated successfully');
    }
}
