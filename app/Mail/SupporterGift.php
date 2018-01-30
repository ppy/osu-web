<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
        return $this->text(i18n_view('emails.store.supporter_gift'))
            ->with($this->params)
            ->subject(trans('fulfillments.mail.supporter_gift.subject'));
    }
}
