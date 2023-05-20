<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Chat;

use App\Events\ChatChannelEvent;
use App\Exceptions\API;
use App\Exceptions\InvariantException;
use App\Jobs\Notifications\ChannelAnnouncement;
use App\Jobs\Notifications\ChannelMessage;
use App\Libraries\AuthorizationResult;
use App\Libraries\Chat\MessageTask;
use App\Models\LegacyMatch\LegacyMatch;
use App\Models\Multiplayer\Room;
use App\Models\User;
use App\Traits\Memoizes;
use App\Traits\Validatable;
use Carbon\Carbon;
use ChaseConey\LaravelDatadogHelper\Datadog;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use LaravelRedis;
use Redis;

/**
 * @property int[] $allowed_groups
 * @property int $channel_id
 * @property Carbon $creation_time
 * @property-read string $creation_time_json
 * @property string $description
 * @property int|null $last_message_id
 * @property-read Collection<Message> $messages
 * @property int|null $match_id
 * @property bool $moderated
 * @property-read \App\Models\LegacyMatch\LegacyMatch|null $multiplayerMatch
 * @property string $name
 * @property int|null $room_id
 * @property string $type
 * @property-read Collection<UserChannel> $userChannels
 * @method static \Illuminate\Database\Eloquent\Builder PM()
 * @method static \Illuminate\Database\Eloquent\Builder public()
 */
class Channel extends Model
{
    use Memoizes {
        Memoizes::resetMemoized as origResetMemoized;
    }

    use Validatable;

    const ANNOUNCE_MESSAGE_LENGTH_LIMIT = 1024; // limited by column length
    const CHAT_ACTIVITY_TIMEOUT = 60; // in seconds.

    const MAX_FIELD_LENGTHS = [
        'description' => 255,
        'name' => 50,
    ];

    public ?string $uuid = null;

    protected $attributes = [
        'description' => '',
    ];

    protected $casts = [
        'creation_time' => 'datetime',
        'moderated' => 'boolean',
    ];

    protected $primaryKey = 'channel_id';

    private ?Collection $pmUsers;
    private array $preloadedUserChannels = [];

    const TYPES = [
        'announce' => 'ANNOUNCE',
        'public' => 'PUBLIC',
        'private' => 'PRIVATE',
        'multiplayer' => 'MULTIPLAYER',
        'spectator' => 'SPECTATOR',
        'temporary' => 'TEMPORARY',
        'pm' => 'PM',
        'group' => 'GROUP',
    ];

    public static function ack(int $channelId, int $userId, ?int $timestamp = null, ?Redis $redis = null): void
    {
        $timestamp ??= time();
        $redis ??= LaravelRedis::client();
        $key = static::getAckKey($channelId);
        $redis->zadd($key, $timestamp, $userId);
        $redis->expire($key, static::CHAT_ACTIVITY_TIMEOUT * 10);
    }

    /**
     * Creates a chat broadcast Channel and associated UserChannels.
     *
     * @param Collection<User> $users
     */
    public static function createAnnouncement(Collection $users, array $rawParams, ?string $uuid = null): static
    {
        $params = get_params($rawParams, null, [
            'description:string',
            'name:string',
        ], ['null_missing' => true]);

        $params['moderated'] = true;
        $params['type'] = static::TYPES['announce'];

        $channel = new static($params);
        $connection = $channel->getConnection();
        $connection->transaction(function () use ($channel, $connection, $users, $uuid) {
            $channel->saveOrExplode();
            $channel->uuid = $uuid;
            $userChannels = $channel->userChannels()->createMany($users->map(fn ($user) => ['user_id' => $user->getKey()]));
            foreach ($userChannels as $userChannel) {
                // preset to avoid extra queries during permission check.
                $userChannel->setRelation('channel', $channel);
                $userChannel->channel->setUserChannel($userChannel);
            }

            // TODO: only the sender needs this now.
            foreach ($users as $user) {
                (new ChatChannelEvent($channel, $user, 'join'))->broadcast(true);
            }

            $connection->afterCommit(fn () => Datadog::increment('chat.channel.create', 1, ['type' => $channel->type]));
        });

        return $channel;
    }

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

    public static function createPM(User $user1, User $user2)
    {
        $channel = new static([
            'name' => static::getPMChannelName($user1, $user2),
            'type' => static::TYPES['pm'],
            'description' => '', // description is not nullable
        ]);

        $connection = $channel->getConnection();
        $connection->transaction(function () use ($channel, $connection, $user1, $user2) {
            $channel->saveOrExplode();
            $channel->addUser($user1);
            $channel->addUser($user2);
            $channel->setPmUsers([$user1, $user2]);

            $connection->afterCommit(fn () => Datadog::increment('chat.channel.create', 1, ['type' => $channel->type]));
        });

        return $channel;
    }

    public static function findPM(User $user1, User $user2)
    {
        $channelName = static::getPMChannelName($user1, $user2);

        $channel = static::where('name', $channelName)->first();

        $channel?->setPmUsers([$user1, $user2]);

        return $channel;
    }

    public static function getAckKey(int $channelId)
    {
        return "chat:channel:{$channelId}";
    }

    public static function getPMChannelName(User $user1, User $user2): string
    {
        $userIds = [$user1->getKey(), $user2->getKey()];
        sort($userIds);

        return '#pm_'.implode('-', $userIds);
    }

    public function activeUserIds()
    {
        return $this->isPublic()
            ? LaravelRedis::zrangebyscore(static::getAckKey($this->getKey()), now()->subSeconds(static::CHAT_ACTIVITY_TIMEOUT)->timestamp, 'inf')
            : $this->userIds();
    }

    /**
     * This check is used for whether the user can enter into the input box for the channel,
     * not if a message is actually allowed to be sent.
     */
    public function checkCanMessage(User $user): AuthorizationResult
    {
        return priv_check_user($user, 'ChatChannelCanMessage', $this);
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

    public function setDescriptionAttribute(?string $value)
    {
        $this->attributes['description'] = trim($value ?? '');
    }

    public function setNameAttribute(?string $value)
    {
        $this->attributes['name'] = presence(trim($value));
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

    public function users(): Collection
    {
        return $this->memoize(__FUNCTION__, function () {
            if ($this->isPM() && isset($this->pmUsers)) {
                return $this->pmUsers;
            }

            // This isn't a has-many-through because the User and UserChannel are in different databases.
            return User::whereIn('user_id', $this->userIds())->get();
        });
    }

    public function visibleUsers(?User $user)
    {
        if ($this->isPM() || $this->isAnnouncement() && priv_check_user($user, 'ChatAnnounce', $this)->can()) {
            return $this->users();
        }

        return new Collection();
    }

    public function scopePublic($query)
    {
        return $query->where('type', static::TYPES['public']);
    }

    public function scopePM($query)
    {
        return $query->where('type', static::TYPES['pm']);
    }

    public function getAttribute($key)
    {
        return match ($key) {
            'channel_id',
            'description',
            'last_message_id',
            'name',
            'type' => $this->getRawAttribute($key),

            'moderated' => (bool) $this->getRawAttribute($key),

            'allowed_groups' => $this->getAllowedGroups(),
            'match_id' => $this->getMatchId(),
            'room_id' => $this->getRoomId(),

            'creation_time' => $this->getTimeFast($key),

            'creation_time_json' => $this->getJsonTimeFast($key),

            'messages',
            'multiplayerMatch',
            'userChannels' => $this->getRelationValue($key),
        };
    }

    public function isAnnouncement()
    {
        return $this->type === static::TYPES['announce'];
    }

    public function isHideable()
    {
        return $this->isPM() || $this->isAnnouncement();
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
        return $this->type === static::TYPES['temporary'] && starts_with($this->name, ['#mp_', '#spect_']);
    }

    public function isValid()
    {
        $this->validationErrors()->reset();

        if ($this->name === null) {
            $this->validationErrors()->add('name', 'required');
        }

        $this->validateDbFieldLengths();

        return $this->validationErrors()->isEmpty();
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
            return $this->users()->firstWhere('user_id', '<>', $userId);
        });
    }

    public function receiveMessage(User $sender, ?string $content, bool $isAction = false, ?string $uuid = null)
    {
        if (!$this->isAnnouncement()) {
            $content = str_replace(["\r", "\n"], ' ', trim($content));
        }

        if (!present($content)) {
            throw new API\ChatMessageEmptyException(osu_trans('api.error.chat.empty'));
        }

        $maxLength = $this->isAnnouncement() ? static::ANNOUNCE_MESSAGE_LENGTH_LIMIT : config('osu.chat.message_length_limit');
        if (mb_strlen($content, 'UTF-8') > $maxLength) {
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
        [,$sent] = LaravelRedis::transaction()
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

        $message->sender()->associate($sender)->channel()->associate($this)
            ->uuid = $uuid; // relay any message uuid back.

        $message->getConnection()->transaction(function () use ($message, $sender) {
            $message->save();

            $this->update(['last_message_id' => $message->getKey()]);

            $userChannel = $this->userChannelFor($sender);

            if ($userChannel) {
                $userChannel->markAsRead($message->message_id);
            }

            $this->unhide();

            if ($this->isPM()) {
                (new ChannelMessage($message, $sender))->dispatch();
            } elseif ($this->isAnnouncement()) {
                (new ChannelAnnouncement($message, $sender))->dispatch();
            }

            MessageTask::dispatch($message);
        });

        Datadog::increment('chat.channel.send', 1, ['target' => $this->type]);

        return $message;
    }

    public function addUser(User $user)
    {
        if ($this->isPublic()) {
            static::ack($this->getKey(), $user->getKey());
        }

        $userChannel = $this->userChannelFor($user);

        if ($userChannel !== null) {
            // No check for sending join event, assumming non-hideable channels don't get hidden.
            if (!$userChannel->isHidden()) {
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

        (new ChatChannelEvent($this, $user, 'join'))->broadcast(true);

        Datadog::increment('chat.channel.join', 1, ['type' => $this->type]);
    }

    public function removeUser(User $user)
    {
        $userChannel = $this->userChannelFor($user);

        if ($userChannel === null) {
            return;
        }

        if ($this->isHideable()) {
            if ($userChannel->isHidden()) {
                return;
            }

            $userChannel->update(['hidden' => true]);
        } else {
            $userChannel->delete();
        }

        $this->resetMemoized();

        (new ChatChannelEvent($this, $user, 'part'))->broadcast(true);

        Datadog::increment('chat.channel.part', 1, ['type' => $this->type]);
    }

    public function hasUser(User $user)
    {
        return $this->userChannelFor($user) !== null;
    }

    public function save(array $options = [])
    {
        return $this->isValid() && parent::save($options);
    }

    public function setPmUsers(array $users)
    {
        $this->pmUsers = new Collection($users);
    }

    public function setUserChannel(UserChannel $userChannel)
    {
        if ($userChannel->channel_id !== $this->getKey()) {
            throw new InvariantException('userChannel does not belong to the channel.');
        }

        $this->preloadedUserChannels[$userChannel->user_id] = $userChannel;
    }

    /**
     * Unhides UserChannels as necessary when receiving messages.
     *
     * @return void
     */
    public function unhide(?User $user = null)
    {
        if (!$this->isHideable()) {
            return;
        }

        $params = [
            'channel_id' => $this->channel_id,
            'hidden' => true,
        ];

        if ($user !== null) {
            $params['user_id'] = $user->getKey();
        }

        $count = UserChannel::where($params)->update([
            'hidden' => false,
        ]);

        if ($count > 0) {
            Datadog::increment('chat.channel.join', 1, ['type' => $this->type], $count);
        }
    }

    public function validationErrorsTranslationPrefix(): string
    {
        return 'chat.channel';
    }

    protected function resetMemoized(): void
    {
        $this->origResetMemoized();
        // simpler to reset preloads since its use-cases are more specific,
        // rather than trying to juggle them to ensure userChannelFor returns as expected.
        $this->preloadedUserChannels = [];
    }

    private function getAllowedGroups(): array
    {
        $value = $this->getRawAttribute('allowed_groups');

        return $value === null ? [] : array_map('intval', explode(',', $value));
    }

    private function getMatchId()
    {
        // TODO: add lazer mp support?
        if ($this->isBanchoMultiplayerChat()) {
            return intval(str_replace('#mp_', '', $this->name));
        }
    }

    private function getRoomId()
    {
        // 9 = strlen('#lazermp_')
        if ($this->isMultiplayer() && substr($this->name, 0, 9) === '#lazermp_') {
            return get_int(substr($this->name, 9));
        }
    }

    private function userChannelFor(User $user): ?UserChannel
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
