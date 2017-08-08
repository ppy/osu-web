<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SupporterGift extends Mailable
{
    use Queueable, SerializesModels;

    private $donor;
    private $giftee;
    private $length;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($donor, $giftee, $length)
    {
        $this->donor = $donor;
        $this->giftee = $giftee;
        $this->length = $length;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.store.supporter_gift')
            ->with('donor', $this->donor)
            ->with('giftee', $this->giftee);
    }
}
