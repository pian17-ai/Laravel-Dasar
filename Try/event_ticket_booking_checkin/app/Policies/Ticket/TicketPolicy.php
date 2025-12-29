<?php

namespace App\Policies\Ticket;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TicketPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Event $event)
    {
        if ($user->id !== $event->created_by) {
            return Response::deny('access forbidden');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Event $event)
    {
        if ($user->id !== $event->created_by) {
            return Response::deny('access forbidden');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Event $event)
    {
        if ($user->id !== $event->created_by) {
            return Response::deny('access forbidden');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Ticket $ticket)
    {
        if ($user->id !== $ticket->event->created_by) {
            return Response::deny('access forbidden');;
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ticket $ticket)
    {
        if ($user->id !== $ticket->event->created_by) {
            return Response::deny('access forbidden');;
        }
        
        return Response::allow();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Ticket $ticket): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Ticket $ticket): bool
    {
        return false;
    }
}
