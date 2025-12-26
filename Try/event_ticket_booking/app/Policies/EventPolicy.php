<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EventPolicy
{
    /**
     * Create a new policy instance.
     */
    public function update (User $user, Event $event) {
        if ($user->id !== $event->created_by) {
            return Response::deny('access forbidden');
        }
        
        return Response::allow();
    }

    public function delete (User $user, Event $event) {
        return $user->id === $event->created_by;
    }
}
