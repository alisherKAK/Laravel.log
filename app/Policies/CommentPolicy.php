<?php

namespace App\Policies;

use App\Models\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Comment $comment)
    {
        return $comment->user->id == $user->id;
    }

}
