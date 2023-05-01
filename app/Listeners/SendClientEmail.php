<?php

namespace App\Listeners;

use App\Events\ClientWelcomed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendClientEmail implements ShouldQueue
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
    public function handle(ClientWelcomed $event): void
    {
        $url = route('clients.update', ['client' => $event->client->id]);
        Mail::to($event->client->email)->send(new ClientWelcomed($event->client->first_name, $url));
    }
}
