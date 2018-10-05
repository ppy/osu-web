<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

use App\Exceptions\ModelNotSavedException;
use App\Traits\Validatable;
use Carbon\Carbon;
use DB;

class BeatmapDiscussionPost extends Model
{
    use Validatable;

    const MESSAGE_LIMIT = 750;

    protected $touches = ['beatmapDiscussion'];

    protected $casts = [
        'system' => 'boolean',
    ];

    protected $dates = ['deleted_at'];

    public static function search($rawParams = [])
    {
        $params = [
            'limit' => clamp(get_int($rawParams['limit'] ?? null) ?? 20, 5, 50),
            'page' => max(get_int($rawParams['page'] ?? null) ?? 1, 1),
        ];

        $query = static::limit($params['limit'])->offset(($params['page'] - 1) * $params['limit']);

        if (isset($rawParams['user'])) {
            $params['user'] = $rawParams['user'];
            $user = User::lookup($params['user']);

            if ($user === null) {
                $query->none();
            } else {
                $query->where('user_id', $user->getKey());
            }
        }

        // only find replies (i.e. exclude discussion starting-posts)
        $query->whereExists(function ($postQuery) {
            $table = (new BeatmapDiscussionPost)->getTable();

            $postQuery->selectRaw(1)
                ->from(DB::raw("{$table} d"))
                ->whereRaw('beatmap_discussion_id = beatmap_discussion_posts.beatmap_discussion_id')
                ->whereRaw("d.id < {$table}.id");
        });

        $query->where('system', 0);

        if (isset($rawParams['sort'])) {
            $sort = explode('-', strtolower($rawParams['sort']));

            if (in_array($sort[0] ?? null, ['id'], true)) {
                $sortField = $sort[0];
            }

            if (in_array($sort[1] ?? null, ['asc', 'desc'], true)) {
                $sortOrder = $sort[1];
            }
        }

        $sortField ?? ($sortField = 'id');
        $sortOrder ?? ($sortOrder = 'desc');

        $params['sort'] = "{$sortField}-{$sortOrder}";
        $query->orderBy($sortField, $sortOrder);

        $params['with_deleted'] = get_bool($rawParams['with_deleted'] ?? null) ?? false;

        if (!$params['with_deleted']) {
            $query->withoutTrashed();
        }

        if (!($rawParams['is_moderator'] ?? false)) {
            $query->whereHas('user', function ($userQuery) {
                $userQuery->default();
            });
        }

        return ['query' => $query, 'params' => $params];
    }

    public static function generateLogResolveChange($user, $resolved)
    {
        return new static([
            'user_id' => $user->user_id,
            'system' => true,
            'message' => [
                'type' => 'resolved',
                'value' => $resolved,
            ],
        ]);
    }

    public static function parseTimestamp($message)
    {
        preg_match('/\b(\d{2,}):([0-5]\d)[:.](\d{3})\b/', $message, $matches);

        if (count($matches) === 4) {
            $m = (int) $matches[1];
            $s = (int) $matches[2];
            $ms = (int) $matches[3];

            return ($m * 60 + $s) * 1000 + $ms;
        }
    }

    public function beatmapset()
    {
        return $this->beatmapDiscussion->beatmapset();
    }

    public function beatmapDiscussion()
    {
        return $this->belongsTo(BeatmapDiscussion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function validateBeatmapsetDiscussion()
    {
        if ($this->beatmapDiscussion === null) {
            $this->validationErrors()->add('beatmap_discussion_id', 'required');

            return;
        }

        // only applies on saved posts
        static $modifiableWhenLocked = [
            'deleted_at',
            'deleted_by_id',
        ];

        if (!$this->exists || count(array_diff(array_keys($this->getDirty()), $modifiableWhenLocked)) > 0) {
            if ($this->beatmapDiscussion->isLocked()) {
                $this->validationErrors()->add('beatmap_discussion_id', '.discussion_locked');
            }
        }
    }

    public function isValid()
    {
        $this->validationErrors()->reset();

        if ($this->deleted_at !== null && $this->isFirstPost()) {
            $this->validationErrors()->add('base', '.first_post');
        }

        $this->validateBeatmapsetDiscussion();

        if (!$this->system) {
            if (!present($this->message)) {
                $this->validationErrors()->add('message', 'required');
            }

            if (mb_strlen($this->message) > static::MESSAGE_LIMIT) {
                $this->validationErrors()->add('message', 'too_long', ['limit' => static::MESSAGE_LIMIT]);
            }
        }

        return $this->validationErrors()->isEmpty();
    }

    public function validationErrorsTranslationPrefix()
    {
        return 'beatmapset_discussion_post';
    }

    public function save(array $options = [])
    {
        if (!$this->isValid()) {
            return false;
        }

        try {
            return $this->getConnection()->transaction(function () use ($options) {
                if (!parent::save($options)) {
                    throw new ModelNotSavedException;
                }

                $this->beatmapDiscussion->refreshTimestampOrExplode();

                return true;
            });
        } catch (ModelNotSavedException $_e) {
            return false;
        }
    }

    public function getMessageAttribute($value)
    {
        if ($this->system) {
            return json_decode($value, true);
        } else {
            return $value;
        }
    }

    public function setMessageAttribute($value)
    {
        // don't shoot me ;_;
        if ($this->system || is_array($value)) {
            $value = json_encode($value);
        }

        $this->attributes['message'] = trim($value);
    }

    public function isFirstPost()
    {
        return !static
            ::where('beatmap_discussion_id', $this->beatmap_discussion_id)
            ->where('id', '<', $this->id)->exists();
    }

    public function relatedSystemPost()
    {
        if ($this->system) {
            return;
        }

        $nextPost = static
            ::where('id', '>', $this->getKey())
            ->orderBy('id', 'ASC')
            ->first();

        if ($nextPost !== null && $nextPost->system && $nextPost->user_id === $this->user_id) {
            return $nextPost;
        }
    }

    public function restore($restoredBy)
    {
        return DB::transaction(function () use ($restoredBy) {
            if ($restoredBy->getKey() !== $this->user_id) {
                BeatmapsetEvent::log(BeatmapsetEvent::DISCUSSION_POST_RESTORE, $restoredBy, $this)->saveOrExplode();
            }

            // restore related system post
            $systemPost = $this->relatedSystemPost();

            if ($systemPost !== null) {
                $systemPost->restore($restoredBy);
            }

            $this->update(['deleted_at' => null]);

            $this->beatmapDiscussion->refreshResolved();

            return true;
        });
    }

    public function softDeleteOrExplode($deletedBy)
    {
        $timestamps = $this->timestamps;

        try {
            DB::transaction(function () use ($deletedBy) {
                if ($deletedBy->getKey() !== $this->user_id) {
                    BeatmapsetEvent::log(BeatmapsetEvent::DISCUSSION_POST_DELETE, $deletedBy, $this)->saveOrExplode();
                }

                // delete related system post
                $systemPost = $this->relatedSystemPost();

                if ($systemPost !== null) {
                    $systemPost->softDeleteOrExplode($deletedBy);
                }

                $this->timestamps = false;
                $this->fill([
                    'deleted_by_id' => $deletedBy->user_id,
                    'deleted_at' => Carbon::now(),
                ])->saveOrExplode();

                $this->beatmapDiscussion->refreshResolved();
            });
        } finally {
            $this->timestamps = $timestamps;
        }
    }

    public function trashed()
    {
        return $this->deleted_at !== null;
    }

    public function timestamp()
    {
        return static::parseTimestamp($this->message);
    }

    public function scopeWithoutTrashed($query)
    {
        $query->whereNull('deleted_at');
    }

    public function scopeWithoutSystem($query)
    {
        $query->where('system', '=', false);
    }
}
