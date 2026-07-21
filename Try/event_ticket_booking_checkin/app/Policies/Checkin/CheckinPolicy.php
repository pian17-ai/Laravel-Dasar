<?php

namespace App\Policies\Checkin;

use App\Models\Booking;
use App\Models\Checkin;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CheckinPolicy
{
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
    public function view(User $user, Checkin $checkin): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Booking $booking)
    {
        if ($user->id !== $booking->user_id) {
            return Response::deny('access forbidden');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Checkin $checkin): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Checkin $checkin): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Checkin $checkin): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Checkin $checkin): bool
    {
        return false;
    }
}
