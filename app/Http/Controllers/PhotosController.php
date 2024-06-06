<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Photos;
use App\Models\PhotoCategory;

class PhotosController extends Controller
{
    //add photos
    public function addPhotos(Request $req)
    {

        $file = $req->file('file');

        $userId =  Auth::user()->id;
        $origName = $file->getClientOriginalName();
        $dbName = Carbon::now()->format('YmdHisv') . '.' . $file->getClientOriginalExtension();

        $file->move('uploads/',$dbName);

        $photoParent = Photos::create([
            'user_id' => $userId,
            'original_name' => $origName,
            'system_name' => $dbName,
            'status' => 1
        ]);

        $categories = explode(",",$req->category);

        foreach($categories as $category){

            PhotoCategory::create([
                'photo_id' => $photoParent->id,
                'category' => $category,
                'status' => 1,
            ]);

        }
        
    }

    // get all photo
    public function fetchAllPhoto(Request $req){

        if($req->filter == 0){
            
            $photos = Photos::all();

        }else{

            $photos = PhotoCategory::leftJoin('photos','photos.id','photo_categories.photo_id')
            ->where('category',$req->filter)->get();

        }

        return view('layouts.photo',compact('photos'));
    }
}
