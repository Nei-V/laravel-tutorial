<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Intervention\Image\Facades\Image;
class PostsController extends Controller

{
    
    //we use this middleware so that all other routs in this controller require authorization
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(){
        //we want to grab all the users we are following. We do: authenticated users, everybody you are following, give me only their users' ID that's in the profiles table.
        $users = auth()->user()->following()->pluck('profiles.user_id');    //we want the user_id column in the profiles table
        
        $posts = Post::whereIn('user_id', $users)->with('user')->orderBy('created_at', 'DESC')->paginate(5);//it will give us the posts
        //orderBy('created_at', 'DESC') can be replaced with "latest()" to retrive posts in descending order(last one first)
        //if we use get() instead of paginate() we will get all the posts - no pagination
        //we added "with('user')" (this is the same "user" that appears in the Post model and is requested when in the posts/index file {{ $post->user->id}} ) because we want all the users to be loaded, not each time one, so there is only a single request for each pagination, not 5 (can be seen in telescope)
        //dd($posts);
        return view('posts.index', compact('posts')); 
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

//the Image class comes from the Intervention package for image manipulation that we installed and are importing in this file.
//we want to make all images square
//we are using fit method in Intervention that gets two argument (the width and height) - this cuts the image to this size
//we have also the method "resize", that resizes the image but doesn't cut it
$image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
$image->save();

//auth()->user()->posts()->create($data);  --we can't use $data because we want to use $imagePath

auth()->user()->posts()->create([
    'caption'=>$data['caption'],
    'image'=>$imagePath,
]);

        //dd(request()->all());

        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(\App\Post $post){ //Laravel knows to look for the $post in the Post model because both here and in the web.php route we use the same variable $post
        //Laravel also adds graceful fail when we do this - use the same variable.

      // dd( $post);

   /*    return view('posts.show', [
          'post' => $post,
      ]);  */

      //same as :
        return view('posts.show', compact('post')); //because is like in the show argument - also "post"

       
        /* $data=request();

        auth()->user()->post()->show([
            'image'=>$data['image'],
            'caption'=>$data['caption'],
        ]); */
    }
}