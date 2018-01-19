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

use Cache;
use Carbon\Carbon;
use DB;

class BeatmapDiscussion extends Model
{
    protected $guarded = [];

    protected $casts = [
        'kudosu_denied' => 'boolean',
        'resolved' => 'boolean',
    ];

    protected $dates = ['deleted_at'];

    const KUDOSU_STEPS = [1, 2, 5];

    const MESSAGE_TYPES = [
        'praise' => 0,
        'suggestion' => 1,
        'problem' => 2,
        'mapper_note' => 3,
        'hype' => 4,
    ];

    const RESOLVABLE_TYPES = [1, 2];
    const KUDOSUABLE_TYPES = [1, 2];

    public static function search($rawParams = [])
    {
        $params = [
            'limit' => clamp(get_int($rawParams['limit'] ?? null) ?? 20, 5, 50),
            'page' => max(get_int($rawParams['page'] ?? null) ?? 1, 1),
        ];

        $query = static::limit($params['limit'])->offset(($params['page'] - 1) * $params['limit']);

        if (present($rawParams['user'] ?? null)) {
            $params['user'] = $rawParams['user'];
            $user = User::lookup($params['user']);

            if ($user === null) {
                $query->none();
            } else {
                $query->where('user_id', '=', $user->getKey());
            }
        } else {
            $params['user'] = null;
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

        if (isset($rawParams['message_types'])) {
            $params['message_types'] = get_arr($rawParams['message_types'], 'get_string');

            $query->ofType($params['message_types']);
        } else {
            $params['message_types'] = array_keys(static::MESSAGE_TYPES);
        }

        $params['with_deleted'] = get_bool($rawParams['with_deleted'] ?? null) ?? false;

        if (!$params['with_deleted']) {
            $query->withoutDeleted();
        }

        // TODO: readd this when content becomes public
        // $query->whereHas('user', function ($userQuery) {
        //     $userQuery->default();
        // });

        return ['query' => $query, 'params' => $params];
    }

    public function beatmap()
    {
        return $this->belongsTo(Beatmap::class, 'beatmap_id')->withTrashed();
    }

    public function beatmapset()
    {
        return $this->belongsTo(Beatmapset::class, 'beatmapset_id', 'beatmapset_id');
    }

    public function beatmapDiscussionPosts()
    {
        return $this->hasMany(BeatmapDiscussionPost::class);
    }

    public function startingPost()
    {
        return $this->hasOne(BeatmapDiscussionPost::class)->whereNotExists(function ($query) {
            $table = (new BeatmapDiscussionPost)->getTable();

            $query->selectRaw(1)
                ->from(DB::raw("{$table} d"))
                ->where('beatmap_discussion_id', $this->beatmap_discussion_id)
                ->whereRaw("d.id < {$table}.id");
        });
    }

    public function beatmapDiscussionVotes()
    {
        return $this->hasMany(BeatmapDiscussionVote::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kudosuHistory()
    {
        return $this->morphMany(KudosuHistory::class, 'kudosuable');
    }

    public function getMessageTypeAttribute($value)
    {
        return array_search_null(get_int($value), static::MESSAGE_TYPES);
    }

    public function setMessageTypeAttribute($value)
    {
        return $this->attributes['message_type'] = static::MESSAGE_TYPES[$value] ?? null;
    }

    public function getResolvedAttribute($value)
    {
        return $this->canBeResolved() ? (bool) $value : false;
    }

    public function setResolvedAttribute($value)
    {
        if (!$this->canBeResolved()) {
            $value = false;
        }

        // Ensure isDirty works as expected.
        // Reference: https://github.com/laravel/internals/issues/349
        $this->attributes['resolved'] = $value ? 1 : 0;
    }

    public function canBeResolved()
    {
        return in_array($this->attributes['message_type'] ?? null, static::RESOLVABLE_TYPES, true);
    }

    public function canGrantKudosu()
    {
        return
            in_array($this->attributes['message_type'] ?? null, static::KUDOSUABLE_TYPES, true) &&
            $this->user_id !== $this->beatmapset->user_id &&
            !$this->isDeleted() &&
            ($this->beatmap === null || !$this->beatmap->trashed()) &&
            !$this->kudosu_denied;
    }

    public function refreshKudosu($event, $eventExtraData = [])
    {
        // remove own votes
        $this->beatmapDiscussionVotes()->where([
            'user_id' => $this->user_id,
        ])->delete();

        // inb4 timing problem
        $currentVotes = $this->canGrantKudosu() ?
            (int) $this->beatmapDiscussionVotes()->sum('score') :
            0;
        $kudosuGranted = (int) $this->kudosuHistory()->sum('amount');
        $targetKudosu = 0;

        foreach (static::KUDOSU_STEPS as $step) {
            if ($currentVotes >= $step) {
                $targetKudosu++;
            } else {
                break;
            }
        }

        $change = $targetKudosu - $kudosuGranted;

        if ($change === 0) {
            return;
        }

        DB::transaction(function () use ($change, $event, $eventExtraData, $currentVotes) {
            if ($event === 'vote') {
                if ($change > 0) {
                    $beatmapsetEventType = BeatmapsetEvent::KUDOSU_GAIN;
                } else {
                    $beatmapsetEventType = BeatmapsetEvent::KUDOSU_LOST;
                }

                $eventExtraData['votes'] = $this
                    ->beatmapDiscussionVotes
                    ->map
                    ->forEvent();
            } elseif ($event === 'recalculate') {
                $beatmapsetEventType = BeatmapsetEvent::KUDOSU_RECALCULATE;
            }

            if (isset($beatmapsetEventType)) {
                BeatmapsetEvent::log($beatmapsetEventType, $this->user, $this, $eventExtraData)->saveOrExplode();
            }

            KudosuHistory::create([
                'receiver_id' => $this->user->user_id,
                'amount' => $change,
                'action' => $change > 0 ? 'give' : 'reset',
                'date' => Carbon::now(),
                'kudosuable_type' => static::class,
                'kudosuable_id' => $this->id,
                'details' => [
                    'event' => $event,
                ],
            ]);

            $this->user->update([
                'osu_kudostotal' => DB::raw("osu_kudostotal + {$change}"),
                'osu_kudosavailable' => DB::raw("osu_kudosavailable + {$change}"),
            ]);
        });
    }

    public function refreshResolved()
    {
        $systemPosts = $this
            ->beatmapDiscussionPosts()
            ->withoutDeleted()
            ->where('system', '=', true)
            ->orderBy('id', 'DESC')
            ->get();

        foreach ($systemPosts as $post) {
            if ($post->message['type'] === 'resolved') {
                return $this->update(['resolved' => $post->message['value']]);
            }
        }

        return $this->update(['resolved' => false]);
    }

    public function hasValidBeatmap()
    {
        return
            $this->beatmap_id === null ||
            ($this->beatmap && !$this->beatmap->trashed() && $this->beatmap->beatmapset_id === $this->beatmapset_id);
    }

    public function hasValidMessageType()
    {
        if ($this->message_type === null) {
            return false;
        }

        if (!$this->isDirty('message_type')) {
            return true;
        }

        $validTypes = ['praise', 'problem', 'suggestion'];

        if ($this->user_id === $this->beatmapset->user_id) {
            $validTypes[] = 'mapper_note';
        } else {
            if ($this->beatmap_id === null && $this->beatmapset->canBeHyped() && $this->beatmapset->validateHypeBy($this->user)['result']) {
                $validTypes[] = 'hype';
            }
        }

        return in_array($this->message_type, $validTypes, true);
    }

    public function hasValidTimestamp()
    {
        if ($this->timestamp === null) {
            return true;
        }

        // skip validation if not changed
        if (!$this->isDirty('timestamp')) {
            return true;
        }

        return
            $this->beatmap_id !== null && $this->timestamp >= 0 && $this->timestamp <= ($this->beatmap->total_length) * 1000;
    }

    public function votesSummary()
    {
        $votes = ['up' => 0, 'down' => 0];

        foreach ($this->beatmapDiscussionVotes as $vote) {
            if ($vote->score === 1) {
                $votes['up'] += 1;
            } elseif ($vote->score === -1) {
                $votes['down'] += 1;
            }
        }

        return $votes;
    }

    public function isValid()
    {
        return $this->hasValidBeatmap() &&
            $this->hasValidMessageType() &&
            $this->hasValidTimestamp();
    }

    public function vote($params)
    {
        if (!$this->hasValidBeatmap()) {
            return false;
        }

        return DB::transaction(function () use ($params) {
            $vote = $this->beatmapDiscussionVotes()->where(['user_id' => $params['user_id']])->firstOrNew([]);
            $previousScore = $vote->score ?? 0;
            $vote->fill($params);

            if ($previousScore !== $vote->score) {
                if ($vote->score === 0) {
                    $vote->delete();
                } else {
                    $vote->save();
                }

                $this->userRecentVotesCount($vote->user, true);
                $this->refreshKudosu('vote', ['new_vote' => $vote->forEvent()]);
            }

            return true;
        });
    }

    public function title()
    {
        if ($this->beatmapset !== null) {
            if ($this->beatmap_id === null) {
                return $this->beatmapset->title;
            }

            if ($this->beatmap !== null) {
                return "{$this->beatmapset->title} [{$this->beatmap->version}]";
            }
        }

        return '[deleted beatmap]';
    }

    public function url()
    {
        return route('beatmap-discussions.show', $this->id);
    }

    public function allowKudosu($allowedBy)
    {
        DB::transaction(function () use ($allowedBy) {
            BeatmapsetEvent::log(BeatmapsetEvent::KUDOSU_ALLOW, $allowedBy, $this)->saveOrExplode();
            $this->update(['kudosu_denied' => false]);
            $this->refreshKudosu('allow_kudosu');
        });
    }

    public function denyKudosu($deniedBy)
    {
        DB::transaction(function () use ($deniedBy) {
            BeatmapsetEvent::log(BeatmapsetEvent::KUDOSU_DENY, $deniedBy, $this)->saveOrExplode();
            $this->update([
                'kudosu_denied_by_id' => $deniedBy->user_id ?? null,
                'kudosu_denied' => true,
            ]);
            $this->refreshKudosu('deny_kudosu');
        });
    }

    public function isDeleted()
    {
        return $this->deleted_at !== null;
    }

    public function userRecentVotesCount($user, $increment = false)
    {
        $key = "beatmapDiscussion:{$this->getKey()}:votes:{$user->getKey()}";

        if ($increment) {
            Cache::add($key, 0, 60);

            return Cache::increment($key);
        } else {
            return get_int(Cache::get($key)) ?? 0;
        }
    }

    public function restore($restoredBy)
    {
        DB::transaction(function () use ($restoredBy) {
            if ($restoredBy->getKey() !== $this->user_id) {
                BeatmapsetEvent::log(BeatmapsetEvent::DISCUSSION_RESTORE, $restoredBy, $this)->saveOrExplode();
            }
            $this->update(['deleted_at' => null]);
            $this->refreshKudosu('restore');
        });
    }

    public function save(array $options = [])
    {
        if (!$this->isValid()) {
            return false;
        }

        $ret = parent::save($options);
        $this->beatmapset->refreshCache();

        return $ret;
    }

    public function softDelete($deletedBy)
    {
        DB::transaction(function () use ($deletedBy) {
            if ($deletedBy->getKey() !== $this->user_id) {
                BeatmapsetEvent::log(BeatmapsetEvent::DISCUSSION_DELETE, $deletedBy, $this)->saveOrExplode();
            }
            $this->update([
                'deleted_by_id' => $deletedBy->user_id ?? null,
                'deleted_at' => Carbon::now(),
            ]);
            $this->refreshKudosu('delete');
        });
    }

    public function scopeOfType($query, $types)
    {
        foreach ((array) $types as $type) {
            $intType = static::MESSAGE_TYPES[$type] ?? null;

            if ($intType !== null) {
                $intTypes[] = $intType;
            }
        }

        $query->whereIn('message_type', $intTypes);
    }

    public function scopeOpenIssues($query)
    {
        $query
            ->withoutDeleted()
            ->whereIn('message_type', static::RESOLVABLE_TYPES)
            ->where(function ($query) {
                $query
                    ->has('beatmap')
                    ->orWhereNull('beatmap_id');
            })
            ->where('resolved', '=', false);
    }

    public function scopeWithoutDeleted($query)
    {
        $query->whereNull('deleted_at');
    }
}
