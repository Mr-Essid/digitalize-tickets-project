<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SendMailToUserEvent;
use App\Mail\MailConfirationEmail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMailToUserListner
{
    /**
     * Create the event listener.
     */


    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(SendMailToUserEvent  $event): void
    {
        Mail::to($event->client->email)->send(new MailConfirationEmail($event->client, $event->hash));        

    }
}
