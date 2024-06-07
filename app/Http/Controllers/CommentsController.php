<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    //add comments
    public function addComments(Request $req){

        $userId = Auth::user()->id;
        

        return Comments::create([
            'photo_id' => $req->parentId,
            'user_id' => $userId,
            'comment' => $req->comment
        ]);

    }

    // fetch all comments
    public function fetchComments(Request $req){
        
        

        $comments = Comments::leftJoin('users','users.id','comments.user_id')
        ->select('users.name as name','comments.*')
        ->where('photo_id',$req->parentId)
        ->get(); 

        return view('layouts.comments',compact('comments'));

    }
}
