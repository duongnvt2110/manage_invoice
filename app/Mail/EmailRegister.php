<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EmailRegister extends Mailable
{
    use Queueable, SerializesModels;

    protected $confirmation_token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($confirmation_token)
    {
        //
        $this->confirmation_token = $confirmation_token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.confirm')->with('comfirmation_token',$this->confirmation_token);
    }
}
