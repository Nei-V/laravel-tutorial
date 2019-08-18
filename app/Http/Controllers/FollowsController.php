<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class FollowsController extends Controller
{
    public function store(User $user){
       // return $user->username;   <-just for testing
       
       //we want to follow or unfollow - in laravel there is a method called toggle() that connects and disconnects
       //we get th authenticated user to follow the profile of the user that gets passed to us through the url ($user)
       return auth()->user()->following()->toggle($user->profile);
    }
}
