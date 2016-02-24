<?php

namespace App\Listeners;

use App\Events\ArticleWasPublished;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendNewsletter implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */


    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  ArticleWasPublished  $event
     * @return void
     */
    public function handle(ArticleWasPublished $event)
    {
        $users = User::all();
        foreach($users as $user){
            Mail::raw("Checkout Scotch's new article titled: " . $event->article, function ($message) use ($user) {

                $message->from('chris@scotch.io', 'Chris Sevileya');

                $message->to($user->email);

            });
        }
    }
}
