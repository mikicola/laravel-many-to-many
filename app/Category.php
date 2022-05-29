<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // public $timestamp = false;

    // collego a post
    // posts perche una category puo essere assegnata a piu post
    public function posts(){
        return $this->hasMany('App\Post');
    }
}
