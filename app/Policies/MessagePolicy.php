<?php

namespace Azizner\Policies;

use Azizner\Message;
use Azizner\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
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

    public function show(User $user, Message $message)
    {
        if($user->id === $message->from->id or $user->id === $message->to->id)
        {
            return true;
        }
        return false;
    }

    public function downloadAttachment(User $user, Message $message)
    {
        if($user->id === $message->from->id or $user->id === $message->to->id)
        {
            return true;
        }
        return false;
    }
}
