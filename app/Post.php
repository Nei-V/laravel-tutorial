<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    //we are turning of the guar feature, this is safe because we validate each field of the form separately.
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
