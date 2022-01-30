<?php

namespace App\Listeners;

use App\Events\PostUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendUpdatedNotification
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
     * @param  \App\Events\PostUpdated  $event
     * @return void
     */
    public function handle(PostUpdated $event)
    {
        Mail::to('asadovtahir@gmail.com')->send(new \App\Mail\UpdatedPost($event->post));
    }
}
