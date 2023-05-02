<?php

namespace App\Listeners;

use App\Events\ClientNotified;
use App\Mail\ProfileImageNotified;
use App\Models\Client;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNotification
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
    public function handle(): void
    {
        $clients = Client::whereNull('profile_image')
            ->whereDate('last_notification', '<', Carbon::now()->subDays(3))
            ->get();

        foreach ($clients as $client) {
            // Send a notification to the client

            $url = route('clients.update', ['client' => $client->id]);
            Mail::to($client->email)->send(new ProfileImageNotified($client->first_name, $url));

            // Update the client's last notification date
            $client->update([
                'last_notification' => Carbon::now(),
            ]);
        }
    }
}
