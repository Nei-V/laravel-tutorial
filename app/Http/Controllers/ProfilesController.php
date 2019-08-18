<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
/* use App\User; <---this imports the App namespace to later in the function you can write just "    User::...  " - so in all places where is written \App\User you could write just User */
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;  //this is for the redactor, if we want to use the cache

class ProfilesController extends Controller
{
    public function index(User $user) {
        //if the user is authenticated than grab the authenticated user get true if he follows the $user we get from the link, false if he is not following
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id): false;
        //dd($follows);
        //$user = \App\User::findOrFail($user); //using "findOrFail" instead of just "find" shows correct error page if no user is found (404)
        // dd(\App\User::find($user)); --for debugging
        //return view('profiles/index',['user' => $user]);

//refactor:we moved here the logic to show the counts from the profiles/index because we want to use the cache
//instead of writing this:
//$postCount = $user->posts->count();
//we put the logic inside the cache:

$postCount= Cache::remember(//we can use "rememberForever" if we want permanent cache, than the time argument won't be needed
    'count.posts.' . $user->id, //this line is the cache key - we chose how to name it
    now()->addSeconds(30), //the second parameter is how long we want to store the cache, using the helper function now()
    function () use ($user) {  //this closure uses the $user, to return the logic if no cache value was found (if the 30 seconds have passed)
        return $user->posts->count();
    }
);
//we can check this in Telescope - in cache. if we see "hit", it means the cached value was used

$followersCount = Cache::remember(
    'count.followers.' . $user->id,
    now()->addSeconds(30), // there are many add time functions that can be used
    function () use ($user) {
        return $user->profile->followers->count();
    }
);


$followingCount = Cache::remember(
    'count.following.' . $user->id,
    now()->addSeconds(30),
    function () use ($user) {
        return $user->following->count();
    }
);

//we add these three variable to the array in the compact()

        return view('profiles/index', compact('user','follows','postCount','followersCount','followingCount'));
    }

    /* public function edit($user) {
        $user = \App\User::findOrFail(@user);
        $this->authorize('update', $user->profile);
        return view('profiles/edit',['user'=>$user]);
    } */

    //same as:
    public function edit (\App\User $user){
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function update (\App\User $user) {
        $data = request()->validate([
            'title'=>'required',
            'description'=>'required',
            'url'=>'url',
            'image'=>'',
        ]);
        //dd($data);

        //the unsafe way (because you can enter any user in the link and update their data even without being logged in):
       // $user->profile->update($data);

        //the correct way is to allow only the authorized user to edit->we should use auth()
        
        
        if (request('image')) {
            $imagePath = request('image')->store('profile','public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();
            $imageArray = ['image'=>$imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? [],   //this way, if there is no image, the old image wil remain, otherwise, if the user updates the  profile with no image, it will remove the old image.
        ));//this ignores what we get through the query
        //this is in extra layer of protection - we  also have use permissions because otherwise any logged in user can change other user's profile/data
        //we can't use "update($data) because we want in the image field in the data array to have $imagePath
        return redirect("/profile/{$user->id}");
    }
    
}