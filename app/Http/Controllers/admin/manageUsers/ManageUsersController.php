<?php

namespace App\Http\Controllers\admin\manageUsers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManageUsersController extends Controller
{
    public function showUsers(Request $request){

        //check if the user is admin
        $this ->authorize('admin', $request->user());

        //get the users and pass it down to the view
        $users = User::paginate(6);
        return view("adminViews.userViews.manageUsers",
                         ['users' => $users]);
    }
}
