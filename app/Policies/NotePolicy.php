<?php

namespace Azizner\Policies;

use Azizner\Note;
use Azizner\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
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

    public function edit(User $user, Note $note)
    {
        if($user->id === $note->user_id)
        {
            return true;
        }
        return false;
    }

    public function destroy(User $user, Note $note)
    {
        if($user->id === $note->user_id)
        {
            return true;
        }
        return false;
    }

    public function update(User $user, Note $note)
    {
        if($user->id === $note->user_id)
        {
            return true;
        }
        return false;
    }

}
