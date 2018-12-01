<?php

namespace Azizner\Policies;

use Azizner\Place;
use Azizner\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlacePolicy
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

    public function edit(User $user, Place $place)
    {
        if($user->id === $place->user_id)
        {
            return true;
        }
        return false;
    }

    public function update(User $user, Place $place)
    {
        if($user->id === $place->user_id)
        {
            return true;
        }
        return false;
    }

    public function destroy(User $user, Place $place)
    {
        if($user->id === $place->user_id)
        {
            return true;
        }
        return false;
    }
}
