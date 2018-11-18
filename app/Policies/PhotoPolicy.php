<?php

namespace Azizner\Policies;

use Azizner\Photo;
use Azizner\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhotoPolicy
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

    public function edit(User $user, Photo $photo)
    {
        if($user->id === $photo->user_id)
        {
            return true;
        }
        return false;
    }
}
