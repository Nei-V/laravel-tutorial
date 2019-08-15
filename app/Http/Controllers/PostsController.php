<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller

{
    
    //we use this middleware so that all other routs in this controller require authorization
    public function __construct() {
        $this->middleware('auth');
    }

    public function create(){
        return view('posts/create');  //can be written 'posts.create   -  naming convention - posts like in the controller name, create like in the function name
    }

    public function store(){
        $data = request()->validate([
            'caption'=>'required',
            'image'=>['required','image'], //can also be written like "  'required|image'. form validation rules here: https://laravel.com/docs/5.1/validation#rule-image
        ]);

        /*
        you can write like in artisan tinker:
        $post=new \App\Post();
        $post->caption = $data['caption'];
        $post->image= $data['image];
        $post->save();

but there is an easier way:

\App\Post::create([
'caption'=>$data['caption'],
]);
but this is the same array as in the validate method, so we can just pass $data:
this works because we used validation. 
if we have fields that didn't need validation, they will be ignored (because they are not in $data), therefore we will add them in the validate with empty value - for example 'title'=>''   .
        */

        //the next line doesn't work because the user is not authenticated therefore no user_id is created, and this is a required filed
//       \App\Post::create($data);
//this is why we do this. the user_id will be created by laravel in each post because the user is logged in (the user model knows about the posts), if we are not logged in we get an error that posts() is called on null.

//dd(request('image')->store('uploads','public'));- for debugging
//we are taking the image and us the method store to create a folder (uploads) and then we use a driver (it can be public=local store, s3=amazon or other drivers)
//the uploads folder is created in the storage->app->public folder. this folder is not accessible to the public
//you have to run the command "php artisan storage:link" once in the life of the project to make this directory public
$imagePath = request('image')->store('uploads','public');

//auth()->user()->posts()->create($data);  --we can't use $data because we want to use $imagePath

auth()->user()->posts()->create([
    'caption'=>$data['caption'],
    'image'=>$imagePath,
]);

        //dd(request()->all());

        return redirect('/profile/' . auth()->user()->id);
    }
}