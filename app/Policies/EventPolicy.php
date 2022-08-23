<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Event;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    public function eventCrud(User $user, Event $event)
    {
        return $user->id === $event->user_id ? Response::allow() : Response::denyAsNotFound();
    }
}
