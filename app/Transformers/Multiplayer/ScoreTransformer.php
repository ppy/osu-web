<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\Multiplayer;

use App\Models\Multiplayer\PlaylistItemUserHighScore;
use App\Models\Multiplayer\Score;
use App\Transformers\TransformerAbstract;
use App\Transformers\UserCompactTransformer;

class ScoreTransformer extends TransformerAbstract
{
    // warning: this is actually for PlaylistItemUserHighScore, not for Score
    const BASE_PRELOAD = ['score.user.userProfileCustomization', 'score.user.country'];
    const BASE_INCLUDES = ['user.country', 'user.cover'];

    protected $availableIncludes = [
        'position',
        'scores_around',
        'user',
    ];

    public function transform(Score $score)
    {
        return [
            'id' => $score->id,
            'user_id' => $score->user_id,
            'room_id' => $score->room_id,
            'playlist_item_id' => $score->playlist_item_id,
            'beatmap_id' => $score->beatmap_id,
            'rank' => $score->rank,
            'total_score' => $score->total_score,
            'accuracy' => $score->accuracy,
            'max_combo' => $score->max_combo,
            'mods' => $score->mods,
            'statistics' => $score->statistics,
            'passed' => $score->passed,

            'started_at' => json_time($score->started_at),
            'ended_at' => json_time($score->ended_at),
        ];
    }

    public function includePosition(Score $score)
    {
        return $this->primitive($score->userRank());
    }

    public function includeScoresAround(Score $score)
    {
        $limit = 10;

        $highScorePlaceholder = new PlaylistItemUserHighScore([
            'score_id' => $score->getKey(),
            'total_score' => $score->total_score,
        ]);

        $typeOptions = [
            'higher' => 'score_asc',
            'lower' => 'score_desc',
        ];

        $ret = [];

        foreach ($typeOptions as $type => $sortName) {
            $cursorHelper = PlaylistItemUserHighScore::makeDbCursorHelper($sortName);
            [$highScores, $hasMore] = PlaylistItemUserHighScore
                ::cursorSort($cursorHelper, $highScorePlaceholder)
                ->with(static::BASE_PRELOAD)
                ->where('playlist_item_id', $score->playlist_item_id)
                ->where('user_id', '<>', $score->user_id)
                ->limit($limit)
                ->getWithHasMore();

            $ret[$type] = [
                'scores' => json_collection($highScores->pluck('score'), new static(), static::BASE_INCLUDES),
                'params' => ['limit' => $limit, 'sort' => $cursorHelper->getSortName()],
                'cursor' => $hasMore ? $cursorHelper->next($highScores) : null,
            ];
        }

        return $this->primitive($ret);
    }

    public function includeUser(Score $score)
    {
        return $this->item(
            $score->user,
            new UserCompactTransformer()
        );
    }
}
