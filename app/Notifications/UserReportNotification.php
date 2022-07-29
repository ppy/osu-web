<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Notifications;

use App\Models\User;
use App\Models\UserReport;
use GuzzleHttp\RequestOptions;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class UserReportNotification extends Notification implements ShouldQueue
{
    use Queueable;

    const HTTP_OPTIONS = [
        RequestOptions::CONNECT_TIMEOUT => 5,
        RequestOptions::TIMEOUT => 5,
    ];

    private $reporter;

    public function __construct(User $reporter)
    {
        $this->reporter = $reporter;
    }

    public function toSlack(UserReport $notifiable): SlackMessage
    {
        return (new SlackMessage())
            ->http(static::HTTP_OPTIONS)
            ->attachment(function ($attachment) use ($notifiable) {
                $reportable = $notifiable->reportable;
                $reportableUrl = null;
                if (method_exists($reportable, 'url')) {
                    $reportableUrl = $reportable->url();
                }

                $user = optional($notifiable->user)->username ?? "User {$notifiable->user_id}";
                $userUrl = route('users.show', ['user' => $notifiable->user_id]);

                $reportedText =
                    $reportableUrl !== null
                    ? "<{$reportableUrl}|{$notifiable->reportable_type} {$notifiable->reportable_id}>"
                    : "{$notifiable->reportable_type} {$notifiable->reportable_id}";

                $attachment
                    ->color('warning')
                    ->content($notifiable->comments)
                    ->fields([
                        'Reporter' => "<{$this->reporter->url()}|{$this->reporter->username}>",
                        'Reported' => $reportedText,
                        'User' => "<{$userUrl}|{$user}>",
                        'Reason' => $notifiable->reason,
                    ]);
            });
    }

    public function via($notifiable)
    {
        return ['slack'];
    }
}
