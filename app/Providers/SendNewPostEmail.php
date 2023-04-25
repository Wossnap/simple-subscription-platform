<?php

namespace App\Providers;

use App\Services\EmailService;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewPostEmail implements ShouldQueue
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
    public function handle(PostCreated $event): void
    {
        $subscribers = $event->post->website->subscribers;

        if ($subscribers->first()) {
            foreach ($subscribers as $subscriber) {
                (new EmailService())->sendSubscriptionEmail($subscriber);
            }
        }

    }
}
