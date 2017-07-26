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

    public function beatmapDiscussion()
    {
        return $this->belongsTo(BeatmapDiscussion::class);
    }

    public function beatmapsetDiscussion()
    {
        return $this->beatmapDiscussion->beatmapsetDiscussion();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hasValidMessage()
    {
        return present($this->message);
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

        $this->attributes['message'] = $value;
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

    public function restore($restoredBy)
    {
        return DB::transaction(function () use ($restoredBy) {
            $this->beatmapDiscussion->beatmapset->events()->create([
                'type' => BeatmapsetEvent::DISCUSSION_RESTORE,
                'user_id' => $restoredBy->user_id ?? null,
                'comment' => [
                    'beatmap_discussion_post_id' => $this->getKey(),
                ],
            ]);

            return $this->update(['deleted_at' => null]);
        });
    }

    public function softDelete($deletedBy)
    {
        if ($this->isFirstPost()) {
            return trans('model_validation.beatmap_discussion_post.first_post');
        }

        DB::transaction(function () use ($deletedBy) {
            if (isset($deletedBy->user_id) && $this->user_id !== $deletedBy->user_id) {
                $this->beatmapDiscussion->beatmapset->events()->create([
                    'type' => BeatmapsetEvent::DISCUSSION_DELETE,
                    'user_id' => $deletedBy->user_id ?? null,
                    'comment' => [
                        'beatmap_discussion_post_id' => $this->getKey(),
                    ],
                ]);
            }

            $time = Carbon::now();
            $this->update([
                'deleted_by_id' => $deletedBy->user_id ?? null,
                'deleted_at' => $time,
                'updated_at' => $time,
            ]);
        });
    }

    public function scopeWithoutDeleted($query)
    {
        $query->whereNull('deleted_at');
    }
}
