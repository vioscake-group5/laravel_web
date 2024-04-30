<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable\Envelope;

class TestSendEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

  
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Test Sending Email';
    
    return $this
                ->view('authentication.test_mail')
                // ->text('emails.orders.shipped_plain')
                ->withSwiftMessage(function ($message) use ($subject) {
                    $message->getHeaders()
                            ->addTextHeader('Subject', $subject);
                });
    }
}
