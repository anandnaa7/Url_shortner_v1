<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class UserController extends Controller
{
    //
    public function myProfile(){

    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }
    
}
