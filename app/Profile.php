<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model

{
    protected $guarded=[];

    public function profileImage(){
        //will return either a default image or the image the user uploaded
        $imagePath = ($this->image) ? $this->image : 'profile/5aSivyL1YTqAFYaFSEhRdm8UjcSCwuV3EqrzS6Ua.png';
        return '/storage/' . $imagePath;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
