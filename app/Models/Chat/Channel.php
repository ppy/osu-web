<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Chat;

use App\Events\ChatChannelEvent;
use App\Events\ChatMessageEvent;
use App\Exceptions\API;
use App\Exceptions\InvariantException;
use App\Jobs\Notifications\ChannelMessage;
use App\Models\LegacyMatch\LegacyMatch;
use App\Models\Multiplayer\Room;
use App\Models\User;
use App\Traits\Memoizes;
use Carbon\Carbon;
use ChaseConey\LaravelDatadogHelper\Datadog;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use LaravelRedis as Redis;

/**
 * @property string[] $allowed_groups
 * @property int $channel_id
 * @property \Carbon\Carbon $creation_time
 * @property string $description
 * @property \Illuminate\Database\Eloquent\Collection $messages Message
 * @property int|null $match_id
 * @property int $moderated
 * @property string $name
 * @property int|null $room_id
 * @property mixed $type
 */
class Channel extends Model
{
    use Memoizes;

    const PRELOADED_USERS_KEY = 'preloadedUsers';

    protected $primaryKey = 'channel_id';

    protected $casts = [
        'moderated' => 'boolean',
    ];

    protected $dates = [
        'creation_time',
    ];

    private ?Collection $pmUsers;
    private array $preloadedUserChannels = [];

    const TYPES = [
        'public' => 'PUBLIC',
        'private' => 'PRIVATE',
        'multiplayer' => 'MULTIPLAYER',
        'spectator' => 'SPECTATOR',
        'temporary' => 'TEMPORARY',
        'pm' => 'PM',
        'group' => 'GROUP',
    ];

    public static function createMultiplayer(Room $room)
    {
        if (!$room->exists) {
            throw new InvariantException('cannot create Channel for a Room that has not been persisted.');
        }

        return static::create([
            'name' => "#lazermp_{$room->getKey()}",
            'type' => static::TYPES['multiplayer'],
            'description' => $room->name,
        ]);
    }

    public static function createPM($user1, $user2)
    {
        $channel = new static([
            'name' => static::getPMChannelName($user1, $user2),
            'type' => static::TYPES['pm'],
            'description' => '', // description is not nullable
        ]);

        $channel->getConnection()->transaction(function () use ($channel, $user1, $user2) {
            $channel->save();
            $channel->addUser($user1);
            $channel->addUser($user2);
            $channel->pmUsers = collect([$user1, $user2]);
        });

        return $channel;
    }

    public static function findPM($user1, $user2)
    {
        $channelName = static::getPMChannelName($user1, $user2);

        $channel = static::where('name', $channelName)->first();

        if ($channel !== null) {
            $channel->pmUsers = collect([$user1, $user2]);
        }

        return $channel;
    }

    /**
     * @param User $user1
     * @param User $user2
     *
     * @return string
     */
    public static function getPMChannelName($user1, $user2)
    {
        $userIds = [$user1->getKey(), $user2->getKey()];
        sort($userIds);

        return '#pm_'.implode('-', $userIds);
    }

    /**
     * This check is for whether the user can enter into the input box for the channel,
     * not if a message is actually allowed to be sent.
     */
    public function canMessage(User $user): bool
    {
        return priv_check_user($user, 'ChatChannelCanMessage', $this)->can();
    }

    public function displayIconFor(?User $user): ?string
    {
        return $this->pmTargetFor($user)?->user_avatar;
    }

    public function displayNameFor(?User $user): ?string
    {
        if (!$this->isPM()) {
            return $this->name;
        }

        return $this->pmTargetFor($user)?->username;
    }

    public function isVisibleFor(User $user): bool
    {
        if (!$this->isPM()) {
            return true;
        }

        $targetUser = $this->pmTargetFor($user);

        return !(
            $targetUser === null
            || $user->hasBlocked($targetUser)
            && !($targetUser->isBot() || $targetUser->isModerator() || $targetUser->isAdmin())
        );
    }

    /**
     * Preset the UserChannel with Channel::setUserChannel when handling multiple channels.
     * UserChannelList will automatically do this.
     */
    public function lastReadIdFor(?User $user): ?int
    {
        if ($user === null) {
            return null;
        }

        return $this->userChannelFor($user)?->last_read_id;
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function filteredMessages()
    {
        $messages = $this->messages();

        if ($this->isPublic()) {
            $messages = $messages->where('timestamp', '>', Carbon::now()->subHours(config('osu.chat.public_backlog_limit')));
        }

        // TODO: additional message filtering

        return $messages;
    }

    public function userChannels()
    {
        return $this->hasMany(UserChannel::class);
    }

    public function userIds(): array
    {
        return $this->memoize(__FUNCTION__, function () {
            // 4 = strlen('#pm_')
            if ($this->isPM() && substr($this->name, 0, 4) === '#pm_') {
                $userIds = get_arr(explode('-', substr($this->name, 4)), 'get_int');
            }

            return $userIds ?? $this->userChannels()->pluck('user_id')->all();
        });
    }

    public function users()
    {
        return $this->memoize(__FUNCTION__, function () {
            // use lookup table if it exists
            $usersMap = request()->attributes->get(static::PRELOADED_USERS_KEY);
            if ($usersMap !== null) {
                return collect(array_map(fn ($id) => $usersMap->get($id, null), $this->userIds()));
            }

            // This isn't a has-many-through because the relationship is cross-database.
            return User::whereIn('user_id', $this->userIds())->get();
        });
    }

    public function visibleUsers()
    {
        if ($this->isPM()) {
            return $this->users();
        }

        return collect();
    }

    public function scopePublic($query)
    {
        return $query->where('type', static::TYPES['public']);
    }

    public function scopePM($query)
    {
        return $query->where('type', static::TYPES['pm']);
    }

    public function getAllowedGroupsAttribute($allowed_groups)
    {
        return $allowed_groups === null ? [] : array_map('intval', explode(',', $allowed_groups));
    }

    public function isMultiplayer()
    {
        return $this->type === static::TYPES['multiplayer'];
    }

    public function isPublic()
    {
        return $this->type === static::TYPES['public'];
    }

    public function isPrivate()
    {
        return $this->type === static::TYPES['private'];
    }

    public function isPM()
    {
        return $this->type === static::TYPES['pm'];
    }

    public function isGroup()
    {
        return $this->type === static::TYPES['group'];
    }

    public function isBanchoMultiplayerChat()
    {
        return $this->type === static::TYPES['temporary'] && starts_with($this->name, '#mp_');
    }

    public function getMatchIdAttribute()
    {
        // TODO: add lazer mp support?
        if ($this->isBanchoMultiplayerChat()) {
            return intval(str_replace('#mp_', '', $this->name));
        }
    }

    public function getRoomIdAttribute()
    {
        // 9 = strlen('#lazermp_')
        if ($this->isMultiplayer() && substr($this->name, 0, 9) === '#lazermp_') {
            return get_int(substr($this->name, 9));
        }
    }

    public function multiplayerMatch()
    {
        return $this->belongsTo(LegacyMatch::class, 'match_id');
    }

    public function pmTargetFor(?User $user): ?User
    {
        if (!$this->isPM() || $user === null) {
            return null;
        }

        $userId = $user->getKey();

        return $this->memoize(__FUNCTION__.':'.$userId, function () use ($userId) {
            $users = $this->pmUsers ?? $this->users();

            return $users->firstWhere('user_id', '<>', $userId);
        });
    }

    public function receiveMessage(User $sender, ?string $content, bool $isAction = false, ?string $uuid = null)
    {
        $content = str_replace(["\r", "\n"], ' ', trim($content));

        if (!present($content)) {
            throw new API\ChatMessageEmptyException(osu_trans('api.error.chat.empty'));
        }

        if (mb_strlen($content, 'UTF-8') >= config('osu.chat.message_length_limit')) {
            throw new API\ChatMessageTooLongException(osu_trans('api.error.chat.too_long'));
        }

        if ($this->isPM()) {
            $limit = config('osu.chat.rate_limits.private.limit');
            $window = config('osu.chat.rate_limits.private.window');
            $keySuffix = 'PM';
        } else {
            $limit = config('osu.chat.rate_limits.public.limit');
            $window = config('osu.chat.rate_limits.public.window');
            $keySuffix = 'PUBLIC';
        }

        $key = "message_throttle:{$sender->user_id}:{$keySuffix}";
        $now = now();

        // This works by keeping a sorted set of when the last messages were sent by the user (per message type).
        // The timestamp of the message is used as the score, which allows for zremrangebyscore to cull old messages
        // in a rolling window fashion.
        [,$sent] = Redis::transaction()
            ->zremrangebyscore($key, 0, $now->timestamp - $window)
            ->zrange($key, 0, -1, 'WITHSCORES')
            ->zadd($key, $now->timestamp, (string) Str::uuid())
            ->expire($key, $window)
            ->exec();

        if (count($sent) >= $limit) {
            throw new API\ExcessiveChatMessagesException(osu_trans('api.error.chat.limit_exceeded'));
        }

        $chatFilters = app('chat-filters')->all();

        foreach ($chatFilters as $filter) {
            $content = str_replace($filter->match, $filter->replacement, $content);
        }

        $message = new Message([
            'content' => $content,
            'is_action' => $isAction,
            'timestamp' => $now,
        ]);

        $message->uuid = $uuid; // relay any message uuid back.
        $message->sender()->associate($sender);
        $message->channel()->associate($this);
        $message->save();

        $this->update(['last_message_id' => $message->getKey()]);

        $userChannel = $this->userChannelFor($sender);

        if ($userChannel) {
            $userChannel->markAsRead($message->message_id);
        }

        event(new ChatMessageEvent($message));

        if ($this->isPM()) {
            $this->unhide();
            (new ChannelMessage($message, $sender))->dispatch();
        }

        Datadog::increment('chat.channel.send', 1, ['target' => $this->type]);

        return $message;
    }

    public function addUser(User $user)
    {
        $userChannel = $this->userChannelFor($user);

        if ($userChannel) {
            // already in channel, just broadcast event.
            if (!$userChannel->isHidden()) {
                event(new ChatChannelEvent($userChannel->channel, $user, 'join'));

                return;
            }

            $userChannel->update(['hidden' => false]);
        } else {
            $userChannel = new UserChannel();
            $userChannel->user()->associate($user);
            $userChannel->channel()->associate($this);
            $userChannel->save();
            $this->resetMemoized();
        }

        event(new ChatChannelEvent($userChannel->channel, $user, 'join'));

        Datadog::increment('chat.channel.join', 1, ['type' => $this->type]);
    }

    public function removeUser(User $user)
    {
        $userChannel = UserChannel::where([
            'channel_id' => $this->channel_id,
            'user_id' => $user->user_id,
            'hidden' => false,
        ])->first();

        if (!$userChannel) {
            return;
        }

        if ($this->isPM()) {
            $userChannel->update(['hidden' => true]);
        } else {
            $userChannel->delete();
        }

        event(new ChatChannelEvent($userChannel->channel, $user, 'part'));

        Datadog::increment('chat.channel.part', 1, ['type' => $this->type]);
    }

    public function hasUser(User $user)
    {
        return UserChannel::where([
            'channel_id' => $this->channel_id,
            'user_id' => $user->user_id,
            'hidden' => false,
        ])->exists();
    }

    public function setUserChannel(UserChannel $userChannel)
    {
        if ($userChannel->channel_id !== $this->getKey()) {
            throw new InvariantException('userChannel does not belong to the channel.');
        }

        $this->preloadedUserChannels[$userChannel->user_id] = $userChannel;
    }

    private function unhide()
    {
        if (!$this->isPM()) {
            return;
        }

        UserChannel::where([
            'channel_id' => $this->channel_id,
            'hidden' => true,
        ])->update([
            'hidden' => false,
        ]);
    }

    private function userChannelFor(User $user)
    {
        $userId = $user->getKey();

        return $this->memoize(__FUNCTION__.':'.$userId, function () use ($user, $userId) {
            $userChannel = $this->preloadedUserChannels[$userId] ?? UserChannel::where([
                'channel_id' => $this->channel_id,
                'user_id' => $userId,
            ])->first();

            $userChannel?->setRelation('user', $user);

            return $userChannel;
        });
    }
}
