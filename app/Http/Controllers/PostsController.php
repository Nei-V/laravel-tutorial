<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function create(){
        return view('posts/create');  //can be written 'posts.create   -  naming convention - posts like in the controller name, create like in the function name
    }
}
