<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;
use App\Mail\NotifiyAdminOnRegisterUser;
use App\Mail\NotifiyUserEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailOnRegisterUser implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreatedEvent $event): void
    {
        $user = $event->user;

        Mail::to($user)->send(new NotifiyUserEmail());
        Mail::to('admmin@admin.com')->send(new NotifiyAdminOnRegisterUser());
    }
}
