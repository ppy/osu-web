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

use Carbon\Carbon;
use DB;

class BeatmapDiscussionPost extends Model
{
    protected $guarded = [];

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
                $query->where('user_id', '=', $user->getKey());
            }
        }

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
            $query->withoutDeleted();
        }

        return ['query' => $query, 'params' => $params];
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

    public function hasValidMessage()
    {
        if (is_string($this->message)) {
            return mb_strlen($this->message) <= 500;
        } else {
            return count($this->message) > 0;
        }
    }

    /*
     * Called before saving. Callback definition in
     * App\Providers\AppServiceProviders.
     */
    public function isValid()
    {
        return $this->hasValidMessage();
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

    public function softDelete($deletedBy)
    {
        if ($this->isFirstPost()) {
            return trans('model_validation.beatmap_discussion_post.first_post');
        }

        DB::transaction(function () use ($deletedBy) {
            if ($deletedBy->getKey() !== $this->user_id) {
                BeatmapsetEvent::log(BeatmapsetEvent::DISCUSSION_POST_DELETE, $deletedBy, $this)->saveOrExplode();
            }

            // delete related system post
            $systemPost = $this->relatedSystemPost();

            if ($systemPost !== null) {
                $systemPost->softDelete($deletedBy);
            }

            $time = Carbon::now();

            $this->update([
                'deleted_by_id' => $deletedBy->user_id,
                'deleted_at' => $time,
                'updated_at' => $time,
            ]);

            $this->beatmapDiscussion->refreshResolved();

            return true;
        });
    }

    public function scopeWithoutDeleted($query)
    {
        $query->whereNull('deleted_at');
    }

    public function scopeWithoutSystem($query)
    {
        $query->where('system', '=', false);
    }
}
