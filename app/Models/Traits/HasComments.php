<?php


namespace App\Models\Traits;


use App\Models\Comment;

trait HasComments
{

    function comments() {
        return $this->hasMany(Comment::class)->latest();
    }

}
