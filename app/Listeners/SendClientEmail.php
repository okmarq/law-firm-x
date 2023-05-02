<?php

namespace App\Listeners;

use App\Events\ClientCreated;
use App\Mail\ClientWelcomed;
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
    public function handle(ClientCreated $event): void
    {
        $url = route('clients.update', ['client' => $event->client->id]);
        $mail = new ClientWelcomed($event->client->first_name, $url);

        try {
            Mail::to($event->client->email)->send($mail, $url);
            $event->client->trap('email_sent', [
                'to_email' => $event->client->email,
                'subject' => $mail->envelope()->subject,
                'message' => $mail->content()->markdown,
            ]);
        } catch (\Exception $e) {
            $event->client->trap('email_error', [
                'to_email' => $event->client->email,
                'subject' => $mail->subject,
                'message' => $mail->content(),
                'error' => $e->getMessage(),
            ]);
        }
    }
}
