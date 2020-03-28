<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    protected function hasFavorite(Post $post) {
        $userId = auth()->user()->id;
        return $post->favorites()->where('user_id', $userId)->first();
    }

    function isFavorite(Post $post) {
        return [
          'is_favorite' => $this->hasFavorite($post) !== null
        ];
    }

    function add(Post $post) {
        $userId = auth()->user()->id;

        if($favorite = $this->hasFavorite($post))
            $favorite->delete();
        else
            $post->favorites()->create(['user_id' => $userId]);

        return [
          'status' => 200
        ];
    }
}
