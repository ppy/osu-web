<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Chat;

use App\Jobs\Notifications\ChannelAnnouncement;
use App\Jobs\Notifications\ChannelMessage;
use App\Jobs\Notifications\ChannelTeam;
use App\Models\Traits\Reportable;
use App\Models\Traits\ReportableInterface;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;

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

    public static function filterBacklogs(Channel $channel, Collection $messages): Collection
    {
        if (!$channel->isPublic()) {
            return $messages;
        }

        $minTimestamp = json_time(Carbon::now()->subHours($GLOBALS['cfg']['osu']['chat']['public_backlog_limit']));
        $ret = [];

        foreach ($messages as $message) {
            if ($message->timestamp_json > $minTimestamp) {
                $ret[] = $message;
            }
        }

        return collect($ret);
    }

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

    public function dispatchNotification(): void
    {
        $class = match ($this->channel->type) {
            Channel::TYPES['announce'] => ChannelAnnouncement::class,
            Channel::TYPES['pm'] => ChannelMessage::class,
            Channel::TYPES['team'] => ChannelTeam::class,
            default => null,
        };

        if ($class !== null) {
            new $class($this, $this->sender)->dispatch();
        }
    }

    public function reportableAdditionalInfo(): ?string
    {
        $history = static
            ::where('message_id', '<=', $this->getKey())
            ->whereHas('channel', fn ($ch) => $ch->where('type', '<>', Channel::TYPES['pm']))
            ->where('user_id', $this->user_id)
            ->where('timestamp', '>', CarbonImmutable::now()->subDays(1))
            ->orderBy('timestamp', 'DESC')
            ->with('channel')
            ->limit(5)
            ->get()
            ->map(fn ($m) => "**<t:{$m->timestamp->timestamp}:R> {$m->channel->name}:**\n{$m->content}\n")
            ->reverse()
            ->join("\n");

        $channel = $this->channel;
        $header = 'Reported in: '.($channel->isPM() ? 'pm' : '**'.$channel->name.'** ('.strtolower($channel->type).')');

        return "{$header}\n\n{$history}";
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
