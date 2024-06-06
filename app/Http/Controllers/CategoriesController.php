<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

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
}
