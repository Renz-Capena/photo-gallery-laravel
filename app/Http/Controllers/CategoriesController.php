<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\PhotoCategory;

class CategoriesController extends Controller
{
    //add
    public function addCategory(Request $req){

        Categories::create([
            'category' => $req->categories,
            'status' => 1
        ]);
        
    }

    // fetch all categories
    public function fetchAllCategories(){

        $categories = Categories::all(); 

        return view('layouts.categories',compact('categories'));
    }

    // fetch all categories filter
    public function fetchAllCategoryFilter(){

        $categories = Categories::all(); 

        return view('layouts.categoryFilter',compact('categories'));

    }

    // fetch all categories for edit
    public function fetchAllCategoryEdit(Request $req){

        $photosCategoryTemp = PhotoCategory::where('photo_id',$req->photosId)->where('status',1)->get();

        $photoCategoryFinal = array();

        foreach($photosCategoryTemp as $category){

            array_push($photoCategoryFinal,$category->category);

        }

        $categories = Categories::all(); 

        return view('layouts.photosEdit',compact('categories','photoCategoryFinal'));

    }
}
