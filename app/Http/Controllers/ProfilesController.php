<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/* use App\User; <---this imports the App namespace to later in the function you can write just "    User::...  "*/

class ProfilesController extends Controller
{
    public function index($user) {
        $user = \App\User::find($user);
        // dd(\App\User::find($user)); --for debugging
        return view('home',['user' => $user]);
    }
}