<?php

namespace Azizner\Policies;

use Azizner\User;
use Azizner\Announcement;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnnouncementPolicy
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

    public function update(User $user, Announcement $announcement)
    {
        if($user->id === $announcement->user_id)
        {
            return true;
        }
        return false;
    }

    public function destroy(User $user, Announcement $announcement)
    {
        if($user->id === $announcement->user_id)
        {
            return true;
        }
        return false;
    }

    public function edit(User $user, Announcement $announcement)
    {
        if($user->id === $announcement->user_id)
        {
            return true;
        }
        return false;
    }


}
