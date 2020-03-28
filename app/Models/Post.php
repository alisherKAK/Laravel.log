<?php

namespace App\Models;

use App\Models\Traits\HasComments;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasComments;

    protected $fillable = [
        'title', 'content', 'user_id'
    ];

    function user() {
        return $this->belongsTo(User::class);
    }

    function likes() {
        return $this->hasMany(Like::class);
    }

    function favorites() {
        return $this->hasMany(Favorite::class);
    }
}
