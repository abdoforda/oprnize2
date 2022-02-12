<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function edit_password(){
        return view('user.edit_password');
    }

    public function edit_password_post(Request $request){

        $request->validate([
            'password'=>['required', 'min:8','confirmed'],
            'password_confirmation'=>['required', 'min:8'],
        ]);
        
        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->change_password = false;
        $user->save();

        return "ok";
    }
}
