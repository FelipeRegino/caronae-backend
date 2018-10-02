<?php

namespace Caronae\Notifications;

use Caronae\Channels\PushChannel;
use Caronae\Models\Ride;
use Caronae\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class RideCanceled extends Notification implements ShouldQueue
{
    use Queueable;

    protected $ride;
    protected $user;

    public function __construct(Ride $ride, User $user, String $message)
    {
        $this->ride = $ride;
        $this->user = $user;
        $this->message = $message;
    }

    public function via()
    {
        return ['database', PushChannel::class];
    }

    public function toPush()
    {
        return [
            'id'       => $this->id,
            'message'  => $this->message,
            'msgType'  => 'cancelled',
            'rideId'   => $this->ride->id,
            'senderId' => $this->user->id,
        ];
    }

    public function toArray()
    {
        return [
            'rideID' => $this->ride->id,
        ];
    }
}
