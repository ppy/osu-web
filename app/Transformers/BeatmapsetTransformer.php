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

namespace App\Transformers;

use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\BeatmapsetWatch;
use App\Models\DeletedUser;
use App\Models\User;
use Auth;
use League\Fractal;

class BeatmapsetTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'availability',
        'beatmaps',
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
    ];

    public function transform(Beatmapset $beatmapset = null)
    {
        if ($beatmapset === null) {
            return [];
        }

        return [
            'id' => $beatmapset->beatmapset_id,
            'title' => $beatmapset->title,
            'artist' => $beatmapset->artist,
            'play_count' => $beatmapset->play_count,
            'favourite_count' => $beatmapset->favourite_count,
            'has_favourited' => Auth::check() && Auth::user()->hasFavourited($beatmapset),
            'submitted_date' => json_time($beatmapset->submit_date),
            'last_updated' => json_time($beatmapset->last_update),
            'ranked_date' => json_time($beatmapset->approved_date),
            'creator' => $beatmapset->creator,
            'user_id' => $beatmapset->user_id,
            'bpm' => $beatmapset->bpm,
            'source' => $beatmapset->source,
            'covers' => $beatmapset->allCoverURLs(),
            'preview_url' => $beatmapset->previewURL(),
            'tags' => $beatmapset->tags,
            'video' => $beatmapset->video,
            'storyboard' => $beatmapset->storyboard,
            'ranked' => $beatmapset->approved,
            'status' => $beatmapset->status(),
            'has_scores' => $beatmapset->hasScores(),
            'discussion_enabled' => $beatmapset->discussion_enabled,
            'can_be_hyped' => $beatmapset->canBeHyped(),
            'hype' => [
                'current' => $beatmapset->hype,
                'required' => $beatmapset->requiredHype(),
            ],
            'nominations' => [
                'current' => $beatmapset->nominations,
                'required' => $beatmapset->requiredNominationCount(),
            ],
            'legacy_thread_url' => $beatmapset->thread_id !== 0 ? osu_url('legacy-forum-thread-prefix').$beatmapset->thread_id : null,
        ];
    }

    public function includeAvailability(Beatmapset $beatmapset)
    {
        if (!$beatmapset->download_disabled && !present($beatmapset->download_disabled_url)) {
            return;
        }

        return $this->item($beatmapset, function ($beatmapset) {
            return [
                'download_disabled' => $beatmapset->download_disabled,
                'more_information' => $beatmapset->download_disabled_url,
            ];
        });
    }

    public function includeCurrentUserAttributes(Beatmapset $beatmapset)
    {
        $currentUser = Auth::user();

        if ($currentUser === null) {
            return;
        }

        $hypeValidation = $beatmapset->validateHypeBy($currentUser);

        $ret = [
            'can_hype' => $hypeValidation['result'],
            'can_hype_reason' => $hypeValidation['message'] ?? null,
            'is_watching' => BeatmapsetWatch::check($beatmapset, Auth::user()),
            'new_hype_time' => json_time($currentUser->newHypeTime()),
            'remaining_hype' => $currentUser->remainingHype(),
        ];

        return $this->item($beatmapset, function () use ($ret) {
            return $ret;
        });
    }

    public function includeEvents(Beatmapset $beatmapset)
    {
        return $this->collection(
            $beatmapset->events->all(),
            new BeatmapsetEventTransformer()
        );
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

    public function includeDescription(Beatmapset $beatmapset, Fractal\ParamBag $params)
    {
        $editable = $params->get('editable');

        return $this->item($beatmapset, function ($beatmapset) use ($editable) {
            return $editable
                ? ['description' => $beatmapset->description(), 'bbcode' => $beatmapset->editableDescription()]
                : ['description' => $beatmapset->description()];
        });
    }

    public function includeDiscussions(Beatmapset $beatmapset)
    {
        return $this->collection(
            $beatmapset->beatmapDiscussions,
            new BeatmapDiscussionTransformer()
        );
    }

    public function includeUser(Beatmapset $beatmapset)
    {
        return $this->item(
            $beatmapset->user ?? (new DeletedUser),
            new UserCompactTransformer
        );
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
