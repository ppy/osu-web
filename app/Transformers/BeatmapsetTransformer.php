<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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

use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use League\Fractal;
use League\Fractal\ParamBag;

class BeatmapsetTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'description',
        'user',
        'beatmaps',
        'nominations',
    ];

    public function transform(Beatmapset $beatmapset = null)
    {
        if ($beatmapset === null) {
            return [];
        }

        return [
            'beatmapset_id' => $beatmapset->beatmapset_id,
            'title' => $beatmapset->title,
            'artist' => $beatmapset->artist,
            'play_count' => $beatmapset->play_count,
            'favourite_count' => $beatmapset->favourite_count,
            'submitted_date' => $beatmapset->submit_date->toIso8601String(),
            'ranked_date' => $beatmapset->approved_date ? $beatmapset->approved_date->toIso8601String() : null,
            'creator' => $beatmapset->creator,
            'user_id' => $beatmapset->user_id,
            'bpm' => $beatmapset->bpm,
            'source' => $beatmapset->source,
            'covers' => $beatmapset->allCoverURLs(),
            'previewUrl' => $beatmapset->previewURL(),
            'tags' => $beatmapset->tags,
            'video' => $beatmapset->video,
            'status' => $beatmapset->status(),
        ];
    }

    public function includeNominations(Beatmapset $beatmapset, ParamBag $params = null)
    {
        if ($beatmapset->isPending()) {
            if ($params !== null) {
                $userId = $params->get('user_id')[0];
            }

            $nominations = $beatmapset->recentEvents()->get();
            $disqualified = false;
            foreach ($nominations as $nomination) {
                if ($nomination->type === BeatmapsetEvent::DISQUALIFY) {
                    $disqualified = true;
                    $disqualifyEvent = $nomination;
                }
                if (isset($userId) && $nomination->user_id === $userId && $nomination->type === BeatmapsetEvent::NOMINATE) {
                    $alreadyNominated = true;
                }
            }

            $result = [
                'required' => $beatmapset->requiredNominationCount(),
                'current' => $beatmapset->currentNominationCount(),
            ];
            if ($disqualified) {
                $result['disqualification'] = [
                    'reason' => $disqualifyEvent->comment,
                    'created_at' => $disqualifyEvent->created_at->toIso8601String(),
                ];
            }
            if (isset($userId)) {
                $result['nominated'] = $alreadyNominated ?? false;
            }

            return $this->item($beatmapset, function ($beatmapset) use ($result) {
                return $result;
            });
        } elseif ($beatmapset->qualified()) {
            $eta = $beatmapset->rankingETA();
            $result = [
                'ranking_eta' => $eta ? $eta->toIso8601String() : null,
            ];

            return $this->item($beatmapset, function ($beatmapset) use ($result) {
                return $result;
            });
        } else {
            return;
        }
    }

    public function includeDescription(Beatmapset $beatmapset)
    {
        return $this->item($beatmapset, function ($beatmapset) {
            return [
                'description' => $beatmapset->description(),
            ];
        });
    }

    public function includeUser(Beatmapset $beatmapset)
    {
        return $this->item(
            $beatmapset->user,
            new UserCompactTransformer
        );
    }

    public function includeBeatmaps(Beatmapset $beatmapset)
    {
        return $this->collection(
            $beatmapset->defaultBeatmaps,
            new BeatmapTransformer()
        );
    }
}
