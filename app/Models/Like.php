<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id', 'post_id'
    ];

    function user() {
        return $this->belongsTo(User::class);
    }

    function post() {
        return $this->belongsTo(Post::class);
    }

}
