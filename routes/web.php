<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PhotosController;


// login
Route::get('/', fn () => view('login'))->name('loginFn');

// register
Route::get('register', fn () => view('register'))->name('registerFn'); 

// register
Route::get('home', fn () => view('home'))->name('homeFn'); 

// users controller
Route::controller(Users::class)->group(function(){

    Route::post("registerUser","registerUser")->name('registerUserFn');
    Route::post("loginUser","loginUser")->name("loginUserFn");
    Route::get("logOut","logOut")->name("logOutFn");

});

// categories controller
Route::controller(CategoriesController::class)->group(function(){

    Route::post("addCategory","addCategory")->name("addCategoryFn");
    Route::get("fetchAllCategories","fetchAllCategories")->name("fetchAllCategoriesFn");
    Route::get("fetchAllCategoryFilter","fetchAllCategoryFilter")->name("fetchAllCategoryFilterFn");

});

// photos controller
Route::controller(PhotosController::class)->group(function(){

    Route::post("addPhotos","addPhotos")->name("addPhotosFn");
    Route::get("fetchAllPhoto","fetchAllPhoto")->name("fetchAllPhoto");

});