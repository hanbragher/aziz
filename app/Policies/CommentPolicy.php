<?php

namespace Azizner\Policies;

use Azizner\PhotoComment;
use Azizner\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
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

    public function destroy(User $user, PhotoComment $comment)
    {
        if($user->id == $comment->photo->user->id)
        {
            return true;
        }
        return false;
    }
}
