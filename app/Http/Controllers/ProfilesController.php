<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/* use App\User; <---this imports the App namespace to later in the function you can write just "    User::...  "*/

class ProfilesController extends Controller
{
    public function index($user) {
        $user = \App\User::findOrFail($user); //using "findOrFail" instead of just "find" shows correct error page if no user is found (404)
        // dd(\App\User::find($user)); --for debugging
        return view('profiles/index',['user' => $user]);
    }
}