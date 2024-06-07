<?php

namespace App\Http\Controllers;

use App\Models\Reactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReactionsController extends Controller
{
    //add reaction
    public function addReaction(Request $req){
        
        $userId = Auth::user()->id;

        $checkIfAlreadyReact = Reactions::where('photo_id',$req->id)->where('user_id',$userId)->where('status',1)->first();

        if($checkIfAlreadyReact){

            Reactions::find($checkIfAlreadyReact->id)->update([
                'status' => 0
            ]);

        }else{

            Reactions::create([
                'photo_id' => $req->id,
                'user_id' => $userId,
                'status' => 1
            ]);

        }


    }
}
