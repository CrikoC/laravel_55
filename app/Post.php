<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function category() {
        //creating relationship with the categories model
        return $this->belongsTo('App\Category');
    }

    public function tags() {
        //creating relationship with the tag model
        return $this->belongsToMany('App\Tag');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }
}
