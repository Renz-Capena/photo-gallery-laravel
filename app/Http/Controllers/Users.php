<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Users extends Controller
{
    //register
    public function registerUser(Request $req){
        
        $req->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        return User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => $req->password,
        ]);

    }

    // login
    public function loginUser(Request $req){
        
        $req->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $result = 0;

        $checkUser = User::where('email',$req->email)->first();

        if($checkUser){
            

            if(Hash::check($req->password,$checkUser->password)){

                Auth::login($checkUser);

                $result = 1;

            }else{

                $result = 'Wrong Password!';

            }

        }else{

            $result = 'Wrong Email!';

        }

        return $result;

    }

    // logout
    public function logOut(Request $req){

        Auth::logout();

        return redirect('/');

    }
}
