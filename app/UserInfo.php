<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    public $timestamp = false;

    protected $fillable = [
        'user_id', 'address', 'phone', 'date_of_birth',
    ];

    // collego a user
    public function user() {
        return $this->belongsTo('App\User');
    }
}
