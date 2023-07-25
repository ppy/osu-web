<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\Beatmap;
use App\Models\DeletedUser;
use App\Models\LegacyMatch;
use App\Models\Multiplayer\PlaylistItemUserHighScore;
use App\Models\Multiplayer\ScoreLink as MultiplayerScoreLink;
use App\Models\Score\Best\Model as ScoreBest;
use App\Models\Score\Model as ScoreModel;
use App\Models\Solo\Score as SoloScore;
use App\Models\Traits\SoloScoreInterface;
use League\Fractal\Resource\Item;

class ScoreTransformer extends TransformerAbstract
{
    const MULTIPLAYER_BASE_INCLUDES = ['user.country', 'user.cover'];
    // warning: the preload is actually for PlaylistItemUserHighScore, not for Score
    const MULTIPLAYER_BASE_PRELOAD = [
        'scoreLink.score.performance',
        'scoreLink.user.country',
        'scoreLink.user.userProfileCustomization',
    ];

    const TYPE_LEGACY = 'legacy';
    const TYPE_SOLO = 'solo';

    // TODO: user include is deprecated.
    const USER_PROFILE_INCLUDES = ['beatmap', 'beatmapset', 'user'];
    const USER_PROFILE_INCLUDES_PRELOAD = [
        'beatmap',
        'beatmap.beatmapset',
        // it's for user profile so the user is already available
        // 'user',
    ];

    protected array $availableIncludes = [
        'beatmap',
        'beatmapset',
        'current_user_attributes',
        'match',
        'rank_country',
        'rank_global',
        'user',
        'weight',

        // Only for MultiplayerScoreLink
        'position',
        'scores_around',
    ];

    protected array $defaultIncludes = [
        'current_user_attributes',
    ];

    private string $transformFunction;

    public static function newSolo(): static
    {
        return new static(static::TYPE_SOLO);
    }

    public function __construct(?string $type = null)
    {
        $type ??= is_api_request() && api_version() < 20220705
            ? static::TYPE_LEGACY
            : static::TYPE_SOLO;

        switch ($type) {
            case static::TYPE_LEGACY:
                $this->transformFunction = 'transformLegacy';
                break;
            case static::TYPE_SOLO:
                $this->transformFunction = 'transformSolo';
                break;
        }
    }

    public function transform(LegacyMatch\Score|ScoreModel|SoloScoreInterface $score)
    {
        $fn = $this->transformFunction;

        return $this->$fn($score);
    }

    public function transformSolo(ScoreModel|SoloScoreInterface $score)
    {
        if ($score instanceof ScoreModel) {
            $legacyPerfect = $score->perfect;
            $best = $score->best;

            if ($best !== null) {
                $bestId = $best->getKey();
                $pp = $best->pp;
                $replay = $best->replay;
            }
        } elseif ($score instanceof SoloScoreInterface) {
            $pp = $score->pp;
            $replay = $score->has_replay;

            if ($score instanceof MultiplayerScoreLink) {
                $multiplayerAttributes = [
                    'room_id' => $score->room_id,
                    'playlist_item_id' => $score->playlist_item_id,
                ];
            }
        }

        return [
            ...$score->data->jsonSerialize(),
            ...($multiplayerAttributes ?? []),
            'best_id' => $bestId ?? null,
            'id' => $score->getKey(),
            'legacy_perfect' => $legacyPerfect ?? null,
            'pp' => $pp ?? null,
            'replay' => $replay ?? false,
            'type' => $score->getMorphClass(),
        ];
    }

    public function transformLegacy(LegacyMatch\Score|ScoreModel|SoloScore $score)
    {
        if ($score instanceof ScoreModel) {
            $createdAt = $score->date_json;

            // this `best` relation is also used by `current_user_attributes` include.
            $best = $score->best;

            if ($best !== null) {
                $bestId = $best->getKey();
                $pp = $best->pp;
                $replay = $best->replay ?? false;
            }
        } elseif ($score instanceof SoloScore) {
            $soloScore = $score;
            $score = $soloScore->makeLegacyEntry();
            $score->score_id = $soloScore->getKey();
            $createdAt = $soloScore->created_at_json;
            $type = $soloScore->getMorphClass();
            $pp = $soloScore->pp;
        } else {
            // LegacyMatch\Score
            $createdAt = json_time($score->game->start_time);
        }

        $mode = $score->getMode();

        $statistics = [
            'count_100' => $score->count100,
            'count_300' => $score->count300,
            'count_50' => $score->count50,
            'count_geki' => $score->countgeki,
            'count_katu' => $score->countkatu,
            'count_miss' => $score->countmiss,
        ];

        return [
            'accuracy' => $score->accuracy(),
            'best_id' => $bestId ?? null,
            'created_at' => $createdAt,
            'id' => $score->getKey(),
            'max_combo' => $score->maxcombo,
            'mode' => $mode,
            'mode_int' => Beatmap::modeInt($mode),
            'mods' => $score->enabled_mods,
            'passed' => $score->pass,
            'perfect' => $score->perfect,
            'pp' => $pp ?? null,
            // Ranks are hardcoded to "0" for legacy match scores atm, return F instead for now.
            'rank' => $score->rank === '0' ? 'F' : $score->rank,
            'replay' => $replay ?? false,
            'score' => $score->score,
            'statistics' => $statistics,
            'type' => $type ?? $score->getMorphClass(),
            'user_id' => $score->user_id,
        ];
    }

    public function includeBeatmap(LegacyMatch\Score|ScoreModel|SoloScore $score)
    {
        $beatmap = $score->beatmap;

        if ($score->getMode() !== $beatmap->mode) {
            $beatmap->convert = true;
            $beatmap->playmode = Beatmap::MODES[$score->getMode()];
        }

        return $this->item($beatmap, new BeatmapTransformer());
    }

    public function includeBeatmapset(LegacyMatch\Score|ScoreModel|SoloScore $score)
    {
        return $this->item($score->beatmap->beatmapset, new BeatmapsetCompactTransformer());
    }

    public function includeCurrentUserAttributes(LegacyMatch\Score|ScoreModel|SoloScoreInterface $score): Item
    {
        return $this->item($score, new Score\CurrentUserAttributesTransformer());
    }

    public function includeMatch(LegacyMatch\Score $score)
    {
        return $this->primitive([
            'slot' => $score->slot,
            'team' => $score->team,
            'pass' => $score->pass,
        ]);
    }

    public function includePosition(MultiplayerScoreLink $scoreLink)
    {
        return $this->primitive($scoreLink->position());
    }

    public function includeScoresAround(MultiplayerScoreLink $scoreLink)
    {
        $limit = 10;

        $highScorePlaceholder = new PlaylistItemUserHighScore([
            'score_link_id' => $scoreLink->getKey(),
            'total_score' => $scoreLink->data->totalScore,
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
                ->with(static::MULTIPLAYER_BASE_PRELOAD)
                ->where('playlist_item_id', $scoreLink->playlist_item_id)
                ->where('user_id', '<>', $scoreLink->user_id)
                ->limit($limit)
                ->getWithHasMore();

            $ret[$type] = [
                'scores' => json_collection($highScores->pluck('scoreLink.score'), new static(), static::MULTIPLAYER_BASE_INCLUDES),
                'params' => ['limit' => $limit, 'sort' => $cursorHelper->getSortName()],
                ...cursor_for_response($cursorHelper->next($highScores, $hasMore)),
            ];
        }

        return $this->primitive($ret);
    }

    public function includeRankCountry(ScoreBest|SoloScore $score)
    {
        return $this->primitive($score->userRank(['type' => 'country']));
    }

    public function includeRankGlobal(ScoreBest|SoloScore $score)
    {
        return $this->primitive($score->userRank([]));
    }

    public function includeUser(LegacyMatch\Score|ScoreModel|SoloScoreInterface $score)
    {
        return $this->item(
            $score->user ?? new DeletedUser(['user_id' => $score->user_id]),
            new UserCompactTransformer()
        );
    }

    public function includeWeight(LegacyMatch\Score|ScoreModel|SoloScore $score)
    {
        if (($score instanceof ScoreBest || $score instanceof SoloScore) && $score->weight !== null) {
            return $this->primitive([
                'percentage' => $score->weight * 100,
                'pp' => $score->weightedPp(),
            ]);
        }
    }
}
