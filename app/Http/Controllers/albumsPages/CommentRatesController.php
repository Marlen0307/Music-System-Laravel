<?php

namespace App\Http\Controllers\albumsPages;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Comment;
use App\Models\Rate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CommentRatesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function addCommentandRate(Request $request, Album $album){

       if ($request->rate != 0 ){
           $rate = new Rate([
               'user_id'=> $request->user()->id,
               'rate' => $request->rate,
               'album_id' => $album->id
           ]);

           $album->rates()->save($rate);
       }

       if (!empty($request->comment)){
           $comment = new Comment([
               'user_id'=> $request->user()->id,
               'comment' => $request->comment,
               'album_id' => $album->id
           ]);

           $album->comments()->save($comment);


       }
        return back();
    }

    public function deleteComment(Comment $comment, Request $request){
        $this->authorize('deleteComment', $comment);

        $comment->delete();

        return back();
    }
}
