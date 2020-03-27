<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [
        'user_id', 'post_id', 'content'
    ];

    function user() {
        return $this->belongsTo(User::class);
    }

}
