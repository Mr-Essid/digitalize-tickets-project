<?php

namespace App\Listeners;

use App\Events\SendMailAboutSuccessSubscription;
use App\Mail\SubscriptionSuccessfully;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMailAboutSucessSubscriptionListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */


    public $connection = 'database';
    public $queue = 'default';
    
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    
}
