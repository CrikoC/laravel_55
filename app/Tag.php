<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts() {
        //creating relationship with the post model
        return $this->belongsToMany('App\Post');
    }
}
