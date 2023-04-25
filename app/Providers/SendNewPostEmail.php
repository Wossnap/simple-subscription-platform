<?php

namespace App\Providers;

use App\Mail\SubscriptionMail;
use App\Models\Post;
use App\Providers\PostCreated;
use App\Services\EmailService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

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

        if($subscribers->first()){
           foreach($subscribers as $subscriber){
            (new EmailService())->sendSubscriptionEmail($subscriber);
           }
        }

    }
}
