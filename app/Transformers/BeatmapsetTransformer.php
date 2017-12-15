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
        'nominations',
        'ratings',
        'recent_favourites',
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
            'is_watched' => BeatmapsetWatch::check($beatmapset, Auth::user()),
            'can_be_hyped' => $beatmapset->canBeHyped(),
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
            'remaining_hype' => $currentUser->remainingHype(),
            'new_hype_time' => json_time($currentUser->newHypeTime()),
        ];

        return $this->item($beatmapset, function () use ($ret) {
            return $ret;
        });
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

            $nominations = $beatmapset->recentEvents()->get();

            foreach ($nominations as $nomination) {
                if ($nomination->type === BeatmapsetEvent::DISQUALIFY) {
                    $disqualifyEvent = $nomination;
                }

                if ($currentUser !== null &&
                    $nomination->user_id === $currentUser->user_id &&
                    $nomination->type === BeatmapsetEvent::NOMINATE) {
                    $alreadyNominated = true;
                }
            }

            if (isset($disqualifyEvent)) {
                $result['disqualification'] = [
                    'reason' => $disqualifyEvent->comment,
                    'created_at' => json_time($disqualifyEvent->created_at),
                ];
            }
            if ($currentUser !== null) {
                $result['nominated'] = $alreadyNominated ?? false;
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

    public function includeUser(Beatmapset $beatmapset)
    {
        return $this->item(
            $beatmapset->user ?? (new DeletedUser),
            new UserCompactTransformer
        );
    }

    public function includeBeatmaps(Beatmapset $beatmapset)
    {
        return $this->collection(
            $beatmapset->beatmaps,
            new BeatmapTransformer()
        );
    }

    public function includeConverts(Beatmapset $beatmapset)
    {
        $converts = [];

        foreach (Beatmap::MODES as $modeStr => $modeInt) {
            if ($modeStr === 'osu') {
                continue;
            }

            foreach ($beatmapset->beatmaps as $beatmap) {
                if ($beatmap->mode !== 'osu') {
                    continue;
                }

                $beatmap = clone $beatmap;

                $beatmap->playmode = $modeInt;
                $beatmap->convert = true;

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
            new \App\Transformers\UserCompactTransformer()
        );
    }
}
