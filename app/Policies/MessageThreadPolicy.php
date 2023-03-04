<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\MessageThread;
use App\Models\User;
use JetBrains\PhpStorm\Pure;

class MessageThreadPolicy
{


    #[Pure] public function before(User $user, string $ability)
    {
        if ($user?->isAdministrator())
            return true;

        return null;
    }


    public function replyTo(User $user, MessageThread $messageThread): bool
    {
        /*
         * TODO: handle snowflake authentication
         */
        if (is_null($user) && $messageThread->isCreatedByAnAuthenticatedUser())
            return false;


        return true;
    }


    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MessageThread $messageThread): bool
    {
        if (is_null($user) && $messageThread->isCreatedByAnAuthenticatedUser())
            return false;


        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MessageThread $messageThread): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MessageThread $messageThread): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MessageThread $messageThread): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MessageThread $messageThread): bool
    {
        return false;
    }
}
