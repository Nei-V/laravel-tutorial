<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function create(){
        return view('posts/create');  //can be written 'posts.create   -  naming convention - posts like in the controller name, create like in the function name
    }

    public function store(){
        $data = request()->validate([
            'caption'=>'required',
            'image'=>['required','image'], //can also be written like "  'required|image'. form validation rules here: https://laravel.com/docs/5.1/validation#rule-image
        ]);
        dd(request()->all());
    }
}
