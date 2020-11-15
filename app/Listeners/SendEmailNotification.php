<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\EmailRegister;
use Illuminate\Support\Facades\Mail;
use App\Events\SendMail;

class SendEmailNotification
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
     * @param  object  $event
     * @return void
     */
    public function handle(SendMail $event)
    {
        //
        $user = $event->user;
        $registerForm = $event->registerForm;
        if(app()->environment() == 'local'){
            Mail::to('meocom10@gmail.com')->send(new EmailRegister($user->user_active_key));
        }else{
            Mail::to($registerForm['user_email'])->send(new EmailRegister($user->user_active_key));
        }
    }
}
