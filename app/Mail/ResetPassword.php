<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $confirmation_token;

    protected $user_email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($confirmation_token,$user_email)
    {
        //
        $this->confirmation_token = $confirmation_token;
        $this->user_email = $user_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reset')->with([
            'comfirmation_token'=>$this->confirmation_token,
            'user_email'=>$this->user_email
        ]);
    }
}
