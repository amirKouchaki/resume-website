<?php

namespace App\Listeners;

use App\Events\Registered;
use App\Notifications\EmailUserOnRegistration;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateAdminOnUserRegistration
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param Registered $event
     * @return void
     */
    public function handle(Registered $event): void
    {
        $event->user->notify(new EmailUserOnRegistration());
    }
}
