<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Post;
use App\Policies\CommentPolicy;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class,
        Comment::class => CommentPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
