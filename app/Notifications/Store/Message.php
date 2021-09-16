<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Notifications\Store;

use Carbon\Carbon;
use GuzzleHttp\RequestOptions;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

abstract class Message extends Notification implements ShouldQueue
{
    use Queueable;

    const HTTP_OPTIONS = [
        RequestOptions::CONNECT_TIMEOUT => 5,
        RequestOptions::TIMEOUT => 5,
    ];

    protected $notified_at;

    public function __construct()
    {
        $this->queue = config('store.queue.notifications');
        $this->notified_at = Carbon::now();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // FIXME: remove this after adding the right checks to the tests
        if (
            config('app.env') === 'testing'
            && presence(env('STORE_NOTIFICATION_TESTS'), false) === false
        ) {
            return [];
        }

        return ['slack'];
    }
}
