<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersController extends Controller
{ 
    public function newuser(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
        ]);
        $credentials['password'] = $credentials['password'].$credentials['email'];
        $user = new User;
        $user->name = 'lucy';
        $user->email = $credentials['email'];
        $user->password = Hash::make($credentials['password']);
        $user->save();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return true;
        }
    } 

}
