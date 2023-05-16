<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Chat;

use App\Models\Traits\Reportable;
use App\Models\Traits\ReportableInterface;
use App\Models\User;

/**
 * @property Channel $channel
 * @property int $channel_id
 * @property string $content
 * @property bool $is_action
 * @property int $message_id
 * @property User $sender
 * @property \Carbon\Carbon $timestamp
 * @property int $user_id
 */
class Message extends Model implements ReportableInterface
{
    use Reportable;

    public ?string $uuid = null;

    protected $primaryKey = 'message_id';
    protected $casts = [
        'is_action' => 'boolean',
        'timestamp' => 'datetime',
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeSince($query, $messageId)
    {
        return $query->where('message_id', '>', $messageId);
    }

    public function getAttribute($key)
    {
        return match ($key) {
            'channel_id',
            'content',
            'message_id',
            'user_id' => $this->getRawAttribute($key),

            'is_action' => (bool) $this->getRawAttribute($key),

            'timestamp' => $this->getTimeFast($key),

            'timestamp_json' => $this->getJsonTimeFast($key),

            'channel',
            'reportedIn',
            'sender' => $this->getRelationValue($key),
        };
    }

    public function reportableAdditionalInfo(?User $reporter): ?string
    {
        if (
            !priv_check_user($reporter, 'ChatChannelRead', $this->channel)->can()
            && !priv_check_user($reporter, 'ChatChannelJoin', $this->channel)->can()
        ) {
            return "reporter doesn't actually have access to the reported message";
        }

        $messages = static
            ::where('message_id', '<=', $this->getKey())
            ->where(fn ($q) => $q
                ->whereHas('channel', fn ($ch) => $ch->public())
                ->orWhere('channel_id', $this->channel_id))
            ->orderBy('message_id', 'DESC')
            ->with('channel')
            ->limit(5)
            ->get();

        return $messages
            ->map(fn ($m) => "**{$m->timestamp_json} {$m->channel->name}:**\n{$m->content}\n")
            ->reverse()
            ->join("\n");
    }

    public function trashed(): bool
    {
        return false;
    }

    protected function newReportableExtraParams(): array
    {
        return [
            'reason' => 'Spam',
            'user_id' => $this->user_id,
        ];
    }
}
