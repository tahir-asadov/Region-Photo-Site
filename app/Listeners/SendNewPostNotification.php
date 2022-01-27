<?php

namespace App\Listeners;

use App\Events\PostAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewPostNotification
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
     * @param  \App\Events\PostAdded  $event
     * @return void
     */
    public function handle(PostAdded $event)
    {
        Mail::to('asadovtahir@gmail.com')->send(new \App\Mail\NewPost($event->post));
    }
}
