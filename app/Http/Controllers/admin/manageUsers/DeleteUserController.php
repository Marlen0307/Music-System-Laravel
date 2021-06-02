<?php

namespace App\Http\Controllers\admin\manageUsers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteUserController extends Controller
{
    public function deleteUser(Request $request, User $user){

        //check if the user is admin
        $this->authorize('admin', $request->user());

        //delete the user image form the s3 drive
        Storage::disk('s3')->delete($user->img_src);

        //delete the studio
        $user->delete();

        //return back
        return back();

    }
}
