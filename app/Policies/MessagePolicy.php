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
            if($message->from->id === $message->to->id && $message->from->id == $user->id ){
                return true;
            }

            if(($user->id === $message->from->id && $message->skip_outbox) or
                ($user->id === $message->to->id && $message->skip_inbox)){
                return false;
            }

            return true;
        }
        return false;
    }

    public function downloadAttachment(User $user, Message $message)
    {
        if($user->id === $message->from->id or $user->id === $message->to->id)
        {
            if($message->from->id === $message->to->id && $message->from->id == $user->id ){
                return true;
            }

            if(($user->id === $message->from->id && $message->skip_outbox) or
                ($user->id === $message->to->id && $message->skip_inbox)){
                return false;
            }
            return true;
        }
        return false;
    }

    public function destroy(User $user, Message $message)
    {
        if($user->id === $message->from->id or $user->id === $message->to->id)
        {
            if($message->from->id === $message->to->id && $message->from->id == $user->id ){
                return true;
            }

            if(($user->id === $message->from->id && $message->skip_outbox) or
                ($user->id === $message->to->id && $message->skip_inbox)){
                return false;
            }
            return true;
        }
        return false;
    }
}
