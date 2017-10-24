<?php

namespace App\Mail;

use App\Models\SupporterTag;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupporterGift extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $tries = 5;

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
            'duration' => SupporterTag::getDurationText($length),
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view(i18n_view('emails.store.supporter_gift'))
            ->with($this->params)
            ->subject(trans('fulfillments.mail.supporter_gift.subject'));
    }
}
