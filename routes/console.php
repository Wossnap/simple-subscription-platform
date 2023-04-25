<?php

use App\Mail\SubscriptionMail;
use App\Models\Subscription;
use App\Models\User;
use App\Services\EmailService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('mail:send-latest-post-email', function () {
    $users = User::all();

    $this->withProgressBar($users, function ($user){

            $this->comment('Sending email to ' . $user->email . '.');
            $message = (new EmailService)->sendSubscriptionEmail($user);
            $this->comment($message);
    });

})->purpose('Send users emails that includes all the latest posts of their subscribed websites.');
