<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Jobs\Notifications\BeatmapsetDiscussionPostNew;
use App\Jobs\Notifications\BeatmapsetDiscussionQualifiedProblem;
use App\Jobs\RefreshBeatmapsetUserKudosu;
use App\Traits\Validatable;
use Cache;
use Carbon\Carbon;
use DB;
use Exception;

/**
 * @property \Illuminate\Database\Eloquent\Collection $beatmapDiscussionPosts BeatmapDiscussionPost
 * @property \Illuminate\Database\Eloquent\Collection $beatmapDiscussionVotes BeatmapDiscussionVote
 * @property int|null $beatmap_id
 * @property int $beatmapset_id
 * @property Beatmapset $beatmapset
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property int|null $deleted_by_id
 * @property int $id
 * @property KudosuHistory $kudosuHistory
 * @property bool $kudosu_denied
 * @property int|null $kudosu_denied_by_id
 * @property int|null $message_type
 * @property bool $resolved
 * @property int|null $resolver_id
 * @property BeatmapDiscussionPost $startingPost
 * @property int|null $timestamp
 * @property \Carbon\Carbon|null $updated_at
 * @property User $user
 * @property int|null $user_id
 * @property Beatmap $visibleBeatmap
 * @property Beatmapset $visibleBeatmapset
 */
class BeatmapDiscussion extends Model
{
    use Validatable;

    protected $casts = [
        'kudosu_denied' => 'boolean',
        'resolved' => 'boolean',
    ];

    protected $dates = ['deleted_at', 'last_post_at'];

    const KUDOSU_STEPS = [1, 2, 5];

    const MESSAGE_TYPES = [
        'suggestion' => 1,
        'problem' => 2,
        'mapper_note' => 3,
        'praise' => 0,
        'hype' => 4,
        'review' => 5,
    ];

    const RESOLVABLE_TYPES = [1, 2];
    const KUDOSUABLE_TYPES = [1, 2];

    const VALID_BEATMAPSET_STATUSES = ['ranked', 'qualified', 'disqualified', 'never_qualified'];
    const VOTES_TO_SHOW = 50;

    // FIXME: This and other static search functions should be extracted out.
    public static function search($rawParams = [])
    {
        $pagination = pagination(cursor_from_params($rawParams) ?? $rawParams);

        $params = [
            'limit' => $pagination['limit'],
            'page' => $pagination['page'],
        ];

        $query = static::limit($params['limit'])->offset($pagination['offset']);
        $isModerator = $rawParams['is_moderator'] ?? false;

        if (present($rawParams['user'] ?? null)) {
            $params['user'] = $rawParams['user'];
            $findAll = $isModerator || (($rawParams['current_user_id'] ?? null) === $rawParams['user']);
            $user = User::lookup($params['user'], null, $findAll);

            if ($user === null) {
                $query->none();
            } else {
                $query->where('user_id', '=', $user->getKey());
            }
        } else {
            $params['user'] = null;
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

        $params['sort'] = "{$sortField}_{$sortOrder}";
        $query->orderBy($sortField, $sortOrder);

        if (isset($rawParams['message_types'])) {
            $params['message_types'] = get_arr($rawParams['message_types'], 'get_string');

            $query->ofType($params['message_types']);
        } else {
            $params['message_types'] = array_keys(static::MESSAGE_TYPES);
        }

        $params['beatmapset_status'] = static::getValidBeatmapsetStatus($rawParams['beatmapset_status'] ?? null);
        if ($params['beatmapset_status']) {
            $query->whereHas('beatmapset', function ($beatmapsetQuery) use ($params) {
                $scope = camel_case($params['beatmapset_status']);
                $beatmapsetQuery->$scope();
            });
        }

        $params['beatmapset_id'] = get_int($rawParams['beatmapset_id'] ?? null);
        if ($params['beatmapset_id'] !== null) {
            $query->where('beatmapset_id', $params['beatmapset_id']);
        }

        $params['beatmap_id'] = get_int($rawParams['beatmap_id'] ?? null);
        if ($params['beatmap_id'] !== null) {
            $query->where('beatmap_id', $params['beatmap_id']);
        }

        if (isset($rawParams['mode']) && isset(Beatmap::MODES[$rawParams['mode']])) {
            $params['mode'] = $rawParams['mode'];
            $query->forMode($params['mode']);
        }

        $params['only_unresolved'] = get_bool($rawParams['only_unresolved'] ?? null) ?? false;

        if ($params['only_unresolved']) {
            $query->openIssues();
        }

        $params['with_deleted'] = get_bool($rawParams['with_deleted'] ?? null) ?? false;

        if (!$params['with_deleted']) {
            $query->withoutTrashed();
        }

        return ['query' => $query, 'params' => $params];
    }

    private static function getValidBeatmapsetStatus($rawParam)
    {
        if (in_array($rawParam, static::VALID_BEATMAPSET_STATUSES, true)) {
            return $rawParam;
        }
    }

    public function beatmap()
    {
        return $this->visibleBeatmap()->withTrashed();
    }

    public function visibleBeatmap()
    {
        return $this->belongsTo(Beatmap::class, 'beatmap_id');
    }

    public function beatmapset()
    {
        return $this->visibleBeatmapset()->withTrashed();
    }

    public function visibleBeatmapset()
    {
        return $this->belongsTo(Beatmapset::class, 'beatmapset_id');
    }

    public function beatmapDiscussionPosts()
    {
        return $this->hasMany(BeatmapDiscussionPost::class);
    }

    public function startingPost()
    {
        return $this->hasOne(BeatmapDiscussionPost::class)->whereNotExists(function ($query) {
            $table = (new BeatmapDiscussionPost())->getTable();

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

        $this->attributes['resolved'] = $value;
    }

    public function canBeResolved()
    {
        return in_array($this->attributes['message_type'] ?? null, static::RESOLVABLE_TYPES, true);
    }

    public function canGrantKudosu()
    {
        return in_array($this->attributes['message_type'] ?? null, static::KUDOSUABLE_TYPES, true) &&
            $this->user_id !== $this->beatmapset->user_id &&
            !$this->trashed() &&
            !$this->kudosu_denied;
    }

    public function isProblem()
    {
        return $this->message_type === 'problem';
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
        // remove kudosu by bots here instead of in canGrantKudosu due to
        // the function is also called by transformer without user preloaded
        if ($this->user !== null && $this->user->isBot()) {
            $currentVotes = 0;
        }
        $kudosuGranted = (int) $this->kudosuHistory()->sum('amount');
        $targetKudosu = 0;

        foreach (static::KUDOSU_STEPS as $step) {
            if ($currentVotes >= $step) {
                $targetKudosu++;
            } else {
                break;
            }
        }

        $beatmapsetKudosuGranted = (int) KudosuHistory
            ::where('kudosuable_type', $this->getMorphClass())
            ->whereIn(
                'kudosuable_id',
                static::where('kudosu_denied', '=', false)
                    ->where('beatmapset_id', '=', $this->beatmapset_id)
                    ->where('user_id', '=', $this->user_id)
                    ->select('id')
            )->sum('amount');

        $availableKudosu = config('osu.beatmapset.discussion_kudosu_per_user') - $beatmapsetKudosuGranted;
        $maxChange = $targetKudosu - $kudosuGranted;
        $change = min($availableKudosu, $maxChange);

        if ($change === 0) {
            return;
        }

        // This should only happen when the rule is changed so always assume recalculation.
        if (abs($change) > 1) {
            $event = 'recalculate';
        }

        DB::transaction(function () use ($change, $event, $eventExtraData) {
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
                'kudosuable_type' => $this->getMorphClass(),
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

        // When user lost kudosu, check if there's extra kudosu available.
        if ($event !== 'recalculate' && $change < 0) {
            dispatch(new RefreshBeatmapsetUserKudosu(['beatmapsetId' => $this->beatmapset_id, 'userId' => $this->user_id]));
        }
    }

    public function refreshResolved()
    {
        $systemPosts = $this
            ->beatmapDiscussionPosts()
            ->withoutTrashed()
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

    public function refreshTimestampOrExplode()
    {
        if ($this->timestamp === null) {
            return;
        }

        if ($this->startingPost === null) {
            return;
        }

        return $this->fill([
            'timestamp' => $this->startingPost->timestamp() ?? null,
        ])->saveOrExplode();
    }

    public function fixBeatmapsetId()
    {
        if (!$this->isDirty('beatmap_id') || $this->beatmap === null) {
            return;
        }

        $this->beatmapset_id = $this->beatmap->beatmapset_id;
    }

    public function validateLockStatus()
    {
        static $modifiableWhenLocked = [
            'deleted_at',
            'deleted_by_id',
            'kudosu_denied',
            'kudosu_denied_by_id',
        ];

        if (
            $this->exists &&
            count(array_diff(array_keys($this->getDirty()), $modifiableWhenLocked)) > 0 &&
            $this->isLocked()
        ) {
            $this->validationErrors()->add('base', '.locked');
        }
    }

    public function validateMessageType()
    {
        if ($this->message_type === null) {
            return $this->validationErrors()->add('message_type', 'required');
        }

        if (!$this->isDirty('message_type')) {
            return;
        }

        if ($this->message_type === 'hype') {
            if ($this->beatmap_id !== null) {
                $this->validationErrors()->add('message_type', '.hype_requires_null_beatmap');
            }

            if (!$this->beatmapset->canBeHyped()) {
                $this->validationErrors()->add('message_type', '.beatmapset_no_hype');
            }

            $beatmapsetHypeValidate = $this->beatmapset->validateHypeBy($this->user);

            if (!$beatmapsetHypeValidate['result']) {
                $this->validationErrors()->addTranslated('base', $beatmapsetHypeValidate['message']);
            }
        }
    }

    public function validateParents()
    {
        if ($this->beatmap_id !== null && $this->beatmap === null) {
            $this->validationErrors()->add('beatmap_id', '.invalid_beatmap_id');
        }

        if ($this->beatmapset_id === null) {
            $this->validationErrors()->add('beatmapset_id', 'required');
        } elseif ($this->beatmapset === null) {
            $this->validationErrors()->add('beatmap_id', '.invalid_beatmapset_id');
        }
    }

    public function validateTimestamp()
    {
        // skip validation if not changed
        if (!$this->isDirty('timestamp')) {
            return;
        }

        // skip validation if changed timestamp from null to null
        if ($this->getOriginal('timestamp') === null && $this->timestamp === null) {
            return;
        }

        if ($this->beatmap === null) {
            return $this->validationErrors()->add('beatmap_id', '.beatmap_missing');
        }

        if ($this->timestamp === null) {
            $this->validationErrors()->add('timestamp', 'required');
        }

        if ($this->timestamp < 0) {
            $this->validationErrors()->add('timestamp', '.timestamp.negative');
        }

        // FIXME: total_length is only for existing hit objects.
        // FIXME: The chart in discussion page will need to account this as well.
        if ($this->timestamp > ($this->beatmap->total_length + 10) * 1000) {
            $this->validationErrors()->add('timestamp', '.timestamp.exceeds_beatmapset_length');
        }
    }

    public function isValid()
    {
        $this->validationErrors()->reset();

        $this->validateLockStatus();
        $this->validateParents();
        $this->validateMessageType();
        $this->validateTimestamp();

        return $this->validationErrors()->isEmpty();
    }

    public function validationErrorsTranslationPrefix()
    {
        return 'beatmapset_discussion';
    }

    /*
     * Also applies to:
     * - voting
     * - saving posts (editing, creating)
     */
    public function isLocked()
    {
        if ($this->trashed()) {
            return true;
        }

        if ($this->beatmapset !== null) {
            if ($this->beatmapset->trashed()) {
                return true;
            }
        }

        if ($this->beatmap_id !== null) {
            if ($this->beatmap === null || $this->beatmap->trashed()) {
                return true;
            }
        }

        return false;
    }

    public function votesSummary()
    {
        $votes = [
            'up' => 0,
            'down' => 0,
            'voters' => [
                'up' => [],
                'down' => [],
            ],
        ];

        foreach ($this->beatmapDiscussionVotes->sortByDesc('created_at') as $vote) {
            if ($vote->score === 0) {
                continue;
            }

            $direction = $vote->score > 0 ? 'up' : 'down';

            if ($votes[$direction] < static::VOTES_TO_SHOW) {
                $votes['voters'][$direction][] = $vote->user_id;
            }
            $votes[$direction] += 1;
        }

        return $votes;
    }

    public function vote($params)
    {
        if ($this->isLocked()) {
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
                    try {
                        $vote->save();
                    } catch (Exception $e) {
                        if (is_sql_unique_exception($e)) {
                            // abort and pretend it's saved correctly
                            return true;
                        }

                        throw $e;
                    }
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
        return route('beatmapsets.discussions.show', $this->id);
    }

    public function allowKudosu($allowedBy)
    {
        DB::transaction(function () use ($allowedBy) {
            BeatmapsetEvent::log(BeatmapsetEvent::KUDOSU_ALLOW, $allowedBy, $this)->saveOrExplode();
            $this->fill(['kudosu_denied' => false])->saveOrExplode();
            $this->refreshKudosu('allow_kudosu');
        });
    }

    public function denyKudosu($deniedBy)
    {
        DB::transaction(function () use ($deniedBy) {
            BeatmapsetEvent::log(BeatmapsetEvent::KUDOSU_DENY, $deniedBy, $this)->saveOrExplode();
            $this->fill([
                'kudosu_denied_by_id' => $deniedBy->user_id ?? null,
                'kudosu_denied' => true,
            ])->saveOrExplode();
            $this->refreshKudosu('deny_kudosu');
        });
    }

    public function managedBy(User $user): bool
    {
        $id = $user->getKey();

        return $this->beatmapset->user_id === $id
            || ($this->beatmap !== null && $this->beatmap->user_id === $id);
    }

    public function userRecentVotesCount($user, $increment = false)
    {
        $key = "beatmapDiscussion:{$this->getKey()}:votes:{$user->getKey()}";

        if ($increment) {
            Cache::add($key, 0, 3600);

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
        $this->fixBeatmapsetId();

        if (!$this->isValid()) {
            return false;
        }

        $ret = parent::save($options);
        $this->beatmapset->refreshCache();

        return $ret;
    }

    public function softDeleteOrExplode($deletedBy)
    {
        DB::transaction(function () use ($deletedBy) {
            if ($deletedBy->getKey() !== $this->user_id) {
                BeatmapsetEvent::log(BeatmapsetEvent::DISCUSSION_DELETE, $deletedBy, $this)->saveOrExplode();
            }

            $this->fill([
                'deleted_by_id' => $deletedBy->user_id ?? null,
                'deleted_at' => Carbon::now(),
            ])->saveOrExplode();
            $this->refreshKudosu('delete');
        });
    }

    public function trashed()
    {
        return $this->deleted_at !== null;
    }

    /**
     * Filter based on mode
     *
     * Either:
     * - null beatmap_id (general all) which beatmapset contain beatmap of $mode
     * - beatmap_id which beatmap of $mode
     */
    public function scopeForMode($query, string $modeStr)
    {
        $modeInt = Beatmap::MODES[$modeStr];

        $query->where(function ($q) use ($modeInt) {
            return $q
                ->where(function ($qq) use ($modeInt) {
                    return $qq
                        ->whereNull('beatmap_id')
                        ->whereHas('visibleBeatmapset', function ($beatmapsetQuery) use ($modeInt) {
                            return $beatmapsetQuery->hasMode($modeInt);
                        });
                })
                ->orWhereHas('visibleBeatmap', function ($beatmapQuery) use ($modeInt) {
                    $beatmapQuery->where('playmode', $modeInt);
                });
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

        return $query->whereIn('message_type', $intTypes ?? []);
    }

    public function scopeOpenIssues($query)
    {
        return $query
            ->visible()
            ->whereIn('message_type', static::RESOLVABLE_TYPES)
            ->where(['resolved' => false]);
    }

    public function scopeOpenProblems($query)
    {
        return $query
            ->visible()
            ->ofType('problem')
            ->where(['resolved' => false]);
    }

    public function scopeWithoutTrashed($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function scopeVisible($query)
    {
        return $query->visibleWithTrashed()
            ->withoutTrashed();
    }

    public function scopeVisibleWithTrashed($query)
    {
        return $query->whereHas('visibleBeatmapset')
            ->where(function ($q) {
                $q->whereNull('beatmap_id')
                    ->orWhereHas('visibleBeatmap');
            });
    }
}
