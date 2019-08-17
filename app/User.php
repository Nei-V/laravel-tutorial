<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//We use this method to hook up in the create event - in other words, to make something happen each time we create a user
    protected static function boot() {
        parent::boot();  //this line should always be here - it means the creation of the user - should always run

        //we add this event to be fired when a new user gets created: - there are more events in Eloquent help on laravel site
        static::created(function ($user) {
            $user->profile()->create([
                'title'=>$user->username,  //we make this default: title of the profile will be the username 
            ]);
        });


    }


    public function posts(){
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');//otherwise the order of the shown posts will be the most recent one last
    }

    public function profile() {
        return $this->hasOne(Profile::class);
    }
}
