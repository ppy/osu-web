<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

namespace App\Models;

use Carbon\Carbon;

/**
 * @property Beatmapset $beatmapset
 * @property int $beatmapset_id
 * @property string|null $comment
 * @property \Carbon\Carbon|null $created_at
 * @property int $id
 * @property mixed|null $type
 * @property \Carbon\Carbon|null $updated_at
 * @property User $user
 * @property int|null $user_id
 */
class BeatmapsetEvent extends Model
{
    const NOMINATE = 'nominate';
    const LOVE = 'love';
    const QUALIFY = 'qualify';
    const DISQUALIFY = 'disqualify';
    const APPROVE = 'approve';
    const RANK = 'rank';

    const KUDOSU_ALLOW = 'kudosu_allow';
    const KUDOSU_DENY = 'kudosu_deny';
    const KUDOSU_GAIN = 'kudosu_gain';
    const KUDOSU_LOST = 'kudosu_lost';
    const KUDOSU_RECALCULATE = 'kudosu_recalculate';

    const ISSUE_RESOLVE = 'issue_resolve';
    const ISSUE_REOPEN = 'issue_reopen';

    const DISCUSSION_LOCK = 'discussion_lock';
    const DISCUSSION_UNLOCK = 'discussion_unlock';

    const DISCUSSION_DELETE = 'discussion_delete';
    const DISCUSSION_RESTORE = 'discussion_restore';

    const DISCUSSION_POST_DELETE = 'discussion_post_delete';
    const DISCUSSION_POST_RESTORE = 'discussion_post_restore';

    const NOMINATION_RESET = 'nomination_reset';

    public static function log($type, $user, $object, $extraData = [])
    {
        if ($object instanceof BeatmapDiscussionPost) {
            $discussionPostId = $object->getKey();
            $discussionId = $object->beatmap_discussion_id;
            $beatmapsetId = $object->beatmapDiscussion->beatmapset_id;
        } elseif ($object instanceof BeatmapDiscussion) {
            $discussionId = $object->getKey();
            $beatmapsetId = $object->beatmapset_id;
        } elseif ($object instanceof Beatmapset) {
            $beatmapsetId = $object->getKey();
        }

        return new static([
            'beatmapset_id' => $beatmapsetId,
            'user_id' => isset($user) ? $user->getKey() : null,
            'type' => $type,
            'comment' => array_merge([
                'beatmap_discussion_id' => $discussionId ?? null,
                'beatmap_discussion_post_id' => $discussionPostId ?? null,
            ], $extraData),
        ]);
    }

    public static function search($rawParams = [])
    {
        $params = [
            'limit' => clamp(get_int($rawParams['limit'] ?? null) ?? 20, 5, 50),
            'page' => max(get_int($rawParams['page'] ?? null) ?? 1, 1),
        ];

        $query = static::limit($params['limit'])->offset(($params['page'] - 1) * $params['limit']);
        $searchByUser = present($rawParams['user'] ?? null);

        if ($searchByUser) {
            $params['user'] = $rawParams['user'];
            $user = User::lookup($params['user']);

            if ($user === null) {
                $query->none();
            } else {
                $query->where('user_id', '=', $user->getKey());
            }
        }

        if (isset($rawParams['sort'])) {
            $sort = explode('_', strtolower($rawParams['sort']));

            if (in_array($sort[0] ?? null, ['id'], true)) {
                $sortField = $sort[0];
            }

            if (in_array($sort[1] ?? null, ['asc', 'desc'], true)) {
                $sortOrder = $sort[1];
            }
        }

        $sortField ?? ($sortField = 'id');
        $sortOrder ?? ($sortOrder = 'desc');

        if ($sortField !== 'id' && $sortOrder !== 'desc') {
            $params['sort'] = "{$sortField}_{$sortOrder}";
        }

        $query->orderBy($sortField, $sortOrder);

        $params['types'] = [];

        if (isset($rawParams['type'])) {
            $params['types'][] = $rawParams['type'];
        }

        if (isset($rawParams['types'])) {
            $params['types'] = array_merge($params['types'], get_arr($rawParams['types'], 'get_string') ?? []);
        }

        if ($searchByUser) {
            $allowedTypes = static::types('public');
            if ($rawParams['is_moderator'] ?? false) {
                $allowedTypes = array_merge($allowedTypes, static::types('moderation'));
            }
            if ($rawParams['is_kudosu_moderator'] ?? false) {
                $allowedTypes = array_merge($allowedTypes, static::types('kudosuModeration'));
            }
        } else {
            $allowedTypes = static::types('all');
        }

        $params['types'] = array_intersect($params['types'], $allowedTypes);

        if (empty($params['types'])) {
            if ($searchByUser) {
                $query->whereIn('type', $allowedTypes);
            }
        } else {
            $query->whereIn('type', $params['types']);
        }

        if (isset($rawParams['min_date'])) {
            $timestamp = strtotime($rawParams['min_date']);

            if ($timestamp !== false) {
                $minDate = Carbon::createFromTimestamp($timestamp)->startOfDay();
                $params['min_date'] = json_date($minDate);
                $query->where('created_at', '>=', $minDate);
            }
        }

        if (isset($rawParams['max_date'])) {
            $timestamp = strtotime($rawParams['max_date']);

            if ($timestamp !== false) {
                $maxDate = Carbon::createFromTimestamp($timestamp)->endOfDay();
                $params['max_date'] = json_date($maxDate);
                $query->where('created_at', '<=', $maxDate);
            }
        }

        return ['query' => $query, 'params' => $params];
    }

    /**
     * Currently used for:
     * - generating type filter checkboxes in events index page
     *   - searching by user should limit the allowed types
     * - checking whether or not user id should be visible
     * Order affects how they're displayed.
     */
    public static function types($privilege)
    {
        static $ret;

        if ($ret === null) {
            $ret = [
                'public' => [
                    static::NOMINATE,
                    static::QUALIFY,
                    static::RANK,
                    static::LOVE,
                    static::NOMINATION_RESET,
                    static::DISQUALIFY,

                    static::KUDOSU_GAIN,
                    static::KUDOSU_LOST,
                ],
                'kudosuModeration' => [
                    static::KUDOSU_ALLOW,
                    static::KUDOSU_DENY,
                ],
                'moderation' => [
                    static::APPROVE, // not actually used

                    static::KUDOSU_RECALCULATE,

                    static::ISSUE_RESOLVE,
                    static::ISSUE_REOPEN,

                    static::DISCUSSION_DELETE,
                    static::DISCUSSION_RESTORE,

                    static::DISCUSSION_POST_DELETE,
                    static::DISCUSSION_POST_RESTORE,
                ],
            ];
        }

        if ($privilege === 'all' && !isset($ret['all'])) {
            $all = [];

            foreach ($ret as $_priv => $types) {
                $all = array_merge($all, $types);
            }

            $ret['all'] = $all;
        }

        return $ret[$privilege];
    }

    public function beatmapset()
    {
        return $this->belongsTo(Beatmapset::class, 'beatmapset_id');
    }

    public function getBeatmapDiscussionIdAttribute()
    {
        return $this->comment['beatmap_discussion_id'] ?? null;
    }

    public function beatmapDiscussion()
    {
        return $this->belongsTo(BeatmapDiscussion::class, 'beatmap_discussion_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeNominations($query)
    {
        return $query->where('type', self::NOMINATE);
    }

    public function scopeNominationResets($query)
    {
        return $query->where('type', self::NOMINATION_RESET);
    }

    public function scopeDisqualifications($query)
    {
        return $query->where('type', self::DISQUALIFY);
    }

    public function scopeDisqualificationAndNominationResetEvents($query)
    {
        return $query->whereIn('type', [self::DISQUALIFY, self::NOMINATION_RESET]);
    }

    public function getCommentAttribute($value)
    {
        return json_decode($value, true) ?? $value;
    }

    public function setCommentAttribute($value)
    {
        $this->attributes['comment'] = is_array($value) ? json_encode($value) : $value;
    }

    public function typeForTranslation()
    {
        if ($this->type === 'disqualify' && !is_array($this->comment)) {
            return 'disqualify_legacy';
        }

        return $this->type;
    }
}
