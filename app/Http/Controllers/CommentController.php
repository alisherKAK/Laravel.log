<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\User;
use Illuminate\Http\Request;
use function auth;
use function redirect;

class CommentController extends Controller
{

    function store(Request $request) {

        $request->validate([
            'content' => 'required',
            'post_id' => 'required'
        ]);

        $data = $request->except('_token');

        /** @var User $user */
        $user = auth()->user();
        $comment = $user->comments()->create($data);

        return redirect()->back();
    }

    function destroy(Comment $comment) {
        $this->authorize('delete', $comment);

        $comment->delete();
        return redirect()->back();
    }

}
