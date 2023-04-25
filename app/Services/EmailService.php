<?php

namespace App\Services;

use App\Mail\SubscriptionMail;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendSubscriptionEmail(User $user): string
    {
        $allPosts =  collect();

        foreach($user->subscriptions as $subscription){
            if($subscription->pivot->last_sent_post_id){
                $posts = $subscription->posts()->where('id', '>', $subscription->pivot->last_sent_post_id)->get();
            }else{
                $posts = $subscription->posts;
            }

            $allPosts = $allPosts->merge($posts);

            $latestPost = $posts->sortByDesc('id')->first();

            if($latestPost){
                Subscription::find($subscription->pivot->id)->update([
                    'last_sent_post_id' => $latestPost->id
                ]);
            }

        }

        if($posts->isNotEmpty()){
            Mail::to($user)->send(new SubscriptionMail($posts));
            return 'Successful';
        }else{
            return 'No posts found to send';
        }
    }
}
