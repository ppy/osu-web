<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SupporterGift extends Mailable
{
    use Queueable, SerializesModels;

    private $params;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($donor, $giftee, $length)
    {
        $this->params = [
            'donor' => $donor,
            'giftee' => $giftee,
            'length' => $length,
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.store.supporter_gift')->with($this->params);
    }
}
