<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $otp;
    protected $data;

    /**
     * Create a new message instance.
     *
     * @param int $otp
     * @param array $data
     * @return void
     */
    public function __construct($otp, $data)
    {
        $this->otp = $otp;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->data['subject'])
            ->html($this->data['body']);
    }
}
