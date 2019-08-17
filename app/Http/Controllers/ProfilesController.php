<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/* use App\User; <---this imports the App namespace to later in the function you can write just "    User::...  " - so in all places where is written \App\User you could write just User */
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index($user) {
        $user = \App\User::findOrFail($user); //using "findOrFail" instead of just "find" shows correct error page if no user is found (404)
        // dd(\App\User::find($user)); --for debugging
        return view('profiles/index',['user' => $user]);
    }

    /* public function edit($user) {
        $user = \App\User::findOrFail(@user);
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
        }

        auth()->user()->profile->update(array_merge(
            $data,['image'=>$imagePath]
        ));//this ignores what we get through the query
        //this is in extra layer of protection - we  also have use permissions because otherwise any logged in user can change other user's profile/data
        //we can't use "update($data) because we want in the image field in the data array to have $imagePath
        return redirect("/profile/{$user->id}");
    }
    
}