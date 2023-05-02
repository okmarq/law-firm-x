<?php

namespace App\Jobs;

use App\Mail\ProfileImageNotified;
use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NotifyClient implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->onQueue('notifying');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
//        if (!$this->client->last_notification || $this->client->last_notification < now()->subDays(3)) {
//            $url = route('clients.update', ['client' => $this->client->id]);
//            Mail::to($this->client->email)->send(new ProfileImageNotified($this->client->first_name, $url));
//
//            // Update the client's last notification date
//            $this->client->update([
//                'last_notification' => Carbon::now(),
//            ]);
//        }
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
