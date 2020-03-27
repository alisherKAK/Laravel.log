<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use function auth;
use function optional;

class LikeController extends Controller
{

    function count(Post $post) {
        return [
            'count' => $post->likes->count()
        ];
    }

    protected function hasLike(Post $post) {
        $userId = optional(auth()->user())->id;
        return $post->likes()
            ->where('user_id', $userId)
            ->first();
    }

    function isLiked(Post $post) {
        return [
            'is_liked' => $this->hasLike($post) !== null
        ];
    }

    function like(Post $post) {

        $userId = auth()->user()->id;

        if ($like = $this->hasLike($post))
            $like->delete();
        else
            $post->likes()->create(['user_id' => $userId]);

        return [
            'status' => 200
        ];
    }

}
