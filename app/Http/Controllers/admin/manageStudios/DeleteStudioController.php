<?php

namespace App\Http\Controllers\admin\manageStudios;

use App\Http\Controllers\Controller;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteStudioController extends Controller
{
    public function deleteStudio(Request $request, Studio $studio){

        //check if the user is admin
        $this->authorize('admin', $request->user());

        //delete all of studio users
        $studioUsers = $studio->users()->get();
        foreach ($studioUsers as $user){
            $user->studio_id = null;
            $user->save();
        }

        //delete the studio logo from the s3 drive
        Storage::disk('s3')->delete($studio->img_src);

        //delete the studio
        $studio->delete();

        //redirect back
        return back();


    }
}
