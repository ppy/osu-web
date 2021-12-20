<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Exceptions\InvariantException;
use App\Models\Chat\Channel;
use App\Models\Forum\Topic;

/**
 * @property \Carbon\Carbon|null $created_at
 * @property string $category
 * @property array|null $details
 * @property int $id
 * @property Model $notifiable
 * @property string $notifiable_type
 * @property int $notifiable_id
 * @property int $priority
 * @property User|null $source
 * @property int|null $source_user_id
 * @property string $name
 * @property \Carbon\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection $userNotifications UserNotification
 */
class Notification extends Model
{
    const BEATMAP_OWNER_CHANGE = 'beatmap_owner_change';
    const BEATMAPSET_DISCUSSION_LOCK = 'beatmapset_discussion_lock';
    const BEATMAPSET_DISCUSSION_POST_NEW = 'beatmapset_discussion_post_new';
    const BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM = 'beatmapset_discussion_qualified_problem';
    const BEATMAPSET_DISCUSSION_REVIEW_NEW = 'beatmapset_discussion_review_new';
    const BEATMAPSET_DISCUSSION_UNLOCK = 'beatmapset_discussion_unlock';
    const BEATMAPSET_DISQUALIFY = 'beatmapset_disqualify';
    const BEATMAPSET_LOVE = 'beatmapset_love';
    const BEATMAPSET_NOMINATE = 'beatmapset_nominate';
    const BEATMAPSET_QUALIFY = 'beatmapset_qualify';
    const BEATMAPSET_RANK = 'beatmapset_rank';
    const BEATMAPSET_REMOVE_FROM_LOVED = 'beatmapset_remove_from_loved';
    const BEATMAPSET_RESET_NOMINATIONS = 'beatmapset_reset_nominations';
    const CHANNEL_MESSAGE = 'channel_message';
    const COMMENT_NEW = 'comment_new';
    const FORUM_TOPIC_REPLY = 'forum_topic_reply';
    const USER_ACHIEVEMENT_UNLOCK = 'user_achievement_unlock';
    const USER_BEATMAPSET_NEW = 'user_beatmapset_new';
    const USER_BEATMAPSET_REVIVE = 'user_beatmapset_revive';

    const NAME_TO_CATEGORY = [
        self::BEATMAP_OWNER_CHANGE => 'beatmap_owner_change',
        self::BEATMAPSET_DISCUSSION_LOCK => 'beatmapset_discussion',
        self::BEATMAPSET_DISCUSSION_POST_NEW => 'beatmapset_discussion',
        self::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM => 'beatmapset_problem',
        self::BEATMAPSET_DISCUSSION_REVIEW_NEW => 'beatmapset_discussion',
        self::BEATMAPSET_DISCUSSION_UNLOCK => 'beatmapset_discussion',
        self::BEATMAPSET_DISQUALIFY => 'beatmapset_state',
        self::BEATMAPSET_LOVE => 'beatmapset_state',
        self::BEATMAPSET_NOMINATE => 'beatmapset_state',
        self::BEATMAPSET_QUALIFY => 'beatmapset_state',
        self::BEATMAPSET_RANK => 'beatmapset_state',
        self::BEATMAPSET_REMOVE_FROM_LOVED => 'beatmapset_state',
        self::BEATMAPSET_RESET_NOMINATIONS => 'beatmapset_state',
        self::CHANNEL_MESSAGE => 'channel',
        self::COMMENT_NEW => 'comment',
        self::FORUM_TOPIC_REPLY => 'forum_topic_reply',
        self::USER_ACHIEVEMENT_UNLOCK => 'user_achievement_unlock',
        self::USER_BEATMAPSET_NEW => 'user_beatmapset_new',
        self::USER_BEATMAPSET_REVIVE => 'user_beatmapset_new',
    ];

    const NOTIFIABLE_CLASSES = [
        Beatmapset::class,
        Build::class,
        Channel::class,
        Topic::class,
        NewsPost::class,
        User::class,
    ];

    const SUBTYPES = [
        self::COMMENT_NEW => 'comment',
        self::USER_BEATMAPSET_NEW => 'mapping',
    ];

    protected $casts = [
        'details' => 'array',
    ];

    public static function namesInCategory($category)
    {
        static $categories = [];

        if ($categories === []) {
            foreach (static::NAME_TO_CATEGORY as $key => $value) {
                if (!array_key_exists($value, $categories)) {
                    $categories[$value] = [];
                }

                $categories[$value][] = $key;
            }
        }

        return $categories[$category] ?? [$category];
    }

    public function scopeByIdentity($query, array $params)
    {
        $category = $params['category'] ?? null;
        $objectId = $params['object_id'] ?? null;
        $objectType = $params['object_type'] ?? null;

        if ($objectType !== null) {
            $query->where('notifiable_type', $objectType);
        }

        if ($objectId !== null && $category !== null) {
            if ($objectType === null) {
                throw new InvariantException('object_type is required.');
            }

            $names = Notification::namesInCategory($category);
            $query
                ->where('notifiable_id', $objectId)
                ->whereIn('name', $names);
        }

        return $query;
    }

    public function getCategoryAttribute()
    {
        return static::NAME_TO_CATEGORY[$this->name] ?? $this->name;
    }

    public function notifiable()
    {
        return $this->morphTo();
    }

    public function source()
    {
        return $this->belongsTo(User::class);
    }

    public function toIdentityJson()
    {
        return [
            'category' => $this->category,
            'id' => $this->getKey(),
            'object_id' => $this->notifiable_id,
            'object_type' => $this->notifiable_type,
        ];
    }

    public function userNotifications()
    {
        return $this->hasMany(UserNotification::class);
    }
}
