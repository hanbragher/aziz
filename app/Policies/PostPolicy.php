<?php

namespace Azizner\Policies;

use Azizner\Post;
use Azizner\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Post $post)
    {
        if($user->blog->id === $post->blogger->id and $user->is_blogger)
        {
            return true;
        }
        return false;
    }

    public function destroy(User $user, Post $post)
    {
        if($user->blog->id === $post->blogger->id and $user->is_blogger)
        {
            return true;
        }
        return false;
    }

    public function edit(User $user, Post $post)
    {
        if($user->blog->id === $post->blogger->id and $user->is_blogger)
        {
            return true;
        }
        return false;
    }
}
