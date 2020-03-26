<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'content', 'user_id'
    ];

    function getUserAttribute() {
        return User::find( $this->user_id );
    }

}
