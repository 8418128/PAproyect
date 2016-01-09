<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Painting extends Model
{
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function likesPaintings(){
        return $this->hasMany('App\Likes_painting');
    }

}
