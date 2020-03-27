<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\BeatmapsetWatch;
use App\Models\DeletedUser;
use App\Models\User;
use Auth;
use League\Fractal;

class BeatmapsetTransformer extends BeatmapsetCompactTransformer
{
    protected $defaultIncludes = [
        'has_favourited',
    ];

    protected $permissions = [
        'current_user_attributes' => 'IsNotOAuth',
        'has_favourited' => 'IsSpecialScope', // TODO: make a scope for this.
    ];

    protected $requiredPermission = 'BeatmapsetShow';

    public function __construct()
    {
        static $includes;

        if (!isset($includes)) {
            $includes = array_merge($this->availableIncludes, [
                'converts',
                'current_user_attributes',
                'description',
                'discussions',
                'events',
                'genre',
                'language',
                'nominations',
                'ratings',
                'recent_favourites',
                'related_users',
                'user',
            ]);
        }

        $this->availableIncludes = $includes;
    }

    public function transform(Beatmapset $beatmapset)
    {
        $result = parent::transform($beatmapset);

        return array_merge($result, [
            'availability' => [
                'download_disabled' => $beatmapset->download_disabled,
                'more_information' => $beatmapset->download_disabled_url,
            ],
            'bpm' => $beatmapset->bpm,
            'can_be_hyped' => $beatmapset->canBeHyped(),
            'creator' => $beatmapset->creator,
            'discussion_enabled' => $beatmapset->discussion_enabled,
            'discussion_locked' => $beatmapset->discussion_locked,
            'hype' => [
                'current' => $beatmapset->hype,
                'required' => $beatmapset->requiredHype(),
            ],
            'is_scoreable' => $beatmapset->isScoreable(),
            'last_updated' => json_time($beatmapset->last_update),
            'legacy_thread_url' => $beatmapset->thread_id !== 0 ? route('forum.topics.show', $beatmapset->thread_id) : null,
            'nominations' => [
                'current' => $beatmapset->nominations,
                'required' => $beatmapset->requiredNominationCount(),
            ],
            'ranked' => $beatmapset->approved,
            'ranked_date' => json_time($beatmapset->approved_date),
            'source' => $beatmapset->source,
            'storyboard' => $beatmapset->storyboard,
            'submitted_date' => json_time($beatmapset->submit_date),
            'tags' => $beatmapset->tags,
        ]);
    }

    public function includeBeatmaps(Beatmapset $beatmapset, Fractal\ParamBag $params)
    {
        $rel = $params->get('with_trashed') ? 'allBeatmaps' : 'beatmaps';

        return $this->collection($beatmapset->$rel, new BeatmapTransformer);
    }

    public function includeConverts(Beatmapset $beatmapset)
    {
        $converts = [];

        foreach ($beatmapset->beatmaps as $beatmap) {
            if ($beatmap->mode !== 'osu') {
                continue;
            }

            $difficulties = $beatmap->difficulty;

            foreach (Beatmap::MODES as $modeStr => $modeInt) {
                if ($modeStr === 'osu') {
                    continue;
                }

                $difficulty = $difficulties->where('mode', $modeInt)->where('mods', 0)->first();

                $beatmap = clone $beatmap;

                $beatmap->playmode = $modeInt;
                $beatmap->convert = true;
                $beatmap->difficultyrating = $difficulty ? $difficulty->diff_unified : 0;

                array_push($converts, $beatmap);
            }
        }

        return $this->collection($converts, new BeatmapTransformer);
    }

    public function includeCurrentUserAttributes(Beatmapset $beatmapset)
    {
        $currentUser = Auth::user();

        if ($currentUser === null) {
            return;
        }

        $hypeValidation = $beatmapset->validateHypeBy($currentUser);

        $ret = [
            'can_delete' => !$beatmapset->isScoreable() && priv_check('BeatmapsetDelete', $beatmapset)->can(),
            'can_hype' => $hypeValidation['result'],
            'can_hype_reason' => $hypeValidation['message'] ?? null,
            'can_love' => $beatmapset->isLoveable() && priv_check('BeatmapsetLove')->can(),
            'is_watching' => BeatmapsetWatch::check($beatmapset, Auth::user()),
            'new_hype_time' => json_time($currentUser->newHypeTime()),
            'remaining_hype' => $currentUser->remainingHype(),
        ];

        return $this->item($beatmapset, function () use ($ret) {
            return $ret;
        });
    }

    public function includeDescription(Beatmapset $beatmapset)
    {
        return $this->item($beatmapset, new BeatmapsetDescriptionTransformer);
    }

    public function includeDiscussions(Beatmapset $beatmapset)
    {
        return $this->collection(
            $beatmapset->beatmapDiscussions,
            new BeatmapDiscussionTransformer()
        );
    }

    public function includeEvents(Beatmapset $beatmapset)
    {
        return $this->collection(
            $beatmapset->events->all(),
            new BeatmapsetEventTransformer()
        );
    }

    public function includeHasFavourited(Beatmapset $beatmapset)
    {
        return $this->primitive(auth()->user()->hasFavourited($beatmapset));
    }

    public function includeGenre(Beatmapset $beatmapset)
    {
        return $this->item($beatmapset->genre, new GenreTransformer);
    }

    public function includeLanguage(Beatmapset $beatmapset)
    {
        return $this->item($beatmapset->language, new LanguageTransformer);
    }

    public function includeNominations(Beatmapset $beatmapset)
    {
        if (!in_array($beatmapset->status(), ['wip', 'pending', 'qualified'], true)) {
            return;
        }

        $result = [
            'required_hype' => $beatmapset->requiredHype(),
            'required' => $beatmapset->requiredNominationCount(),
            'current' => $beatmapset->currentNominationCount(),
        ];

        if ($beatmapset->isPending()) {
            $currentUser = Auth::user();
            $disqualificationEvent = $beatmapset->disqualificationEvent();
            $resetEvent = $beatmapset->resetEvent();

            if ($resetEvent !== null && $resetEvent->type === BeatmapsetEvent::NOMINATION_RESET) {
                $result['nomination_reset'] = json_item($resetEvent, 'BeatmapsetEvent');
            }
            if ($disqualificationEvent !== null) {
                $result['disqualification'] = json_item($disqualificationEvent, 'BeatmapsetEvent');
            }
            if ($currentUser !== null) {
                $result['nominated'] = $beatmapset->nominationsSinceReset()->where('user_id', $currentUser->user_id)->exists();
            }
        } elseif ($beatmapset->qualified()) {
            $eta = $beatmapset->rankingETA();
            $result['ranking_eta'] = json_time($eta);
        }

        return $this->item($beatmapset, function ($beatmapset) use ($result) {
            return $result;
        });
    }

    public function includeUser(Beatmapset $beatmapset)
    {
        return $this->item(
            $beatmapset->user ?? (new DeletedUser),
            new UserCompactTransformer
        );
    }

    public function includeRatings(Beatmapset $beatmapset)
    {
        return $this->item($beatmapset, function ($beatmapset) {
            return $beatmapset->ratingsCount();
        });
    }

    public function includeRecentFavourites(Beatmapset $beatmapset)
    {
        return $this->collection(
            $beatmapset->recentFavourites(),
            new UserCompactTransformer
        );
    }

    public function includeRelatedUsers(Beatmapset $beatmapset)
    {
        $userIds = [$beatmapset->user_id];

        foreach ($beatmapset->beatmapDiscussions as $discussion) {
            if (!priv_check('BeatmapDiscussionShow', $discussion)->can()) {
                continue;
            }

            $userIds[] = $discussion->user_id;
            $userIds[] = $discussion->deleted_by_id;

            foreach ($discussion->beatmapDiscussionPosts as $post) {
                if (!priv_check('BeatmapDiscussionPostShow', $post)->can()) {
                    continue;
                }

                $userIds[] = $post->user_id;
                $userIds[] = $post->last_editor_id;
                $userIds[] = $post->deleted_by_id;
            }

            foreach ($discussion->beatmapDiscussionVotes->sortByDesc('created_at')->take(BeatmapDiscussion::VOTES_TO_SHOW) as $vote) {
                $userIds[] = $vote->user_id;
            }
        }

        foreach ($beatmapset->events as $event) {
            if (priv_check('BeatmapsetEventViewUserId', $event)->can()) {
                $userIds[] = $event->user_id;
            }
        }

        $userIds = array_unique($userIds);
        $users = User::with('userGroups')->whereIn('user_id', $userIds)->get();

        return $this->collection($users, new UserCompactTransformer);
    }
}
