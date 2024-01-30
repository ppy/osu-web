<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Libraries\Search\ScoreSearchParams;
use App\Models\Beatmap;
use App\Models\DeletedUser;
use App\Models\LegacyMatch;
use App\Models\Multiplayer\PlaylistItemUserHighScore;
use App\Models\Multiplayer\ScoreLink as MultiplayerScoreLink;
use App\Models\Score\Best\Model as ScoreBest;
use App\Models\Score\Model as ScoreModel;
use App\Models\Solo\Score as SoloScore;
use League\Fractal\Resource\Item;

class ScoreTransformer extends TransformerAbstract
{
    const MULTIPLAYER_BASE_INCLUDES = ['user.country', 'user.cover'];
    // warning: the preload is actually for PlaylistItemUserHighScore, not for Score
    const MULTIPLAYER_BASE_PRELOAD = [
        'scoreLink.score',
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

    public function transform(LegacyMatch\Score|MultiplayerScoreLink|ScoreModel|SoloScore $score)
    {
        $fn = $this->transformFunction;

        return $this->$fn($score);
    }

    public function transformSolo(MultiplayerScoreLink|ScoreModel|SoloScore $score)
    {
        $extraAttributes = [];

        if ($score instanceof MultiplayerScoreLink) {
            $extraAttributes['playlist_item_id'] = $score->playlist_item_id;
            $extraAttributes['room_id'] = $score->playlistItem->room_id;
            $extraAttributes['solo_score_id'] = $score->score_id;
            $score = $score->score;
        }

        $hasReplay = $score->has_replay;

        return [
            ...$extraAttributes,
            ...$score->data->jsonSerialize(),
            'beatmap_id' => $score->beatmap_id,
            'best_id' => $score->best_id,
            'id' => $score->getKey(),
            'rank' => $score->rank,
            'type' => $score->getMorphClass(),
            'user_id' => $score->user_id,
            'accuracy' => $score->accuracy,
            'build_id' => $score->build_id,
            'ended_at' => $score->ended_at_json,
            'has_replay' => $hasReplay,
            'legacy_perfect' => $score->legacy_perfect,
            'legacy_score_id' => $score->legacy_score_id,
            'legacy_total_score' => $score->legacy_total_score,
            'max_combo' => $score->max_combo,
            'passed' => $score->passed,
            'pp' => $score->pp,
            'ranked' => $score->ranked,
            'ruleset_id' => $score->ruleset_id,
            'started_at' => $score->started_at_json,
            'total_score' => $score->total_score,
            // TODO: remove this redundant field sometime after 2024-02
            'replay' => $hasReplay,
        ];

        return $ret;
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
            $createdAt = $soloScore->ended_at_json;
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

    public function includeCurrentUserAttributes(LegacyMatch\Score|MultiplayerScoreLink|ScoreModel|SoloScore $score): Item
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
        static $limit = 10;
        static $transformer;
        $transformer ??= static::newSolo();

        return $this->primitive(array_map(
            function ($item) use ($limit, $transformer) {
                [$highScores, $hasMore] = $item['query']
                    ->with(static::MULTIPLAYER_BASE_PRELOAD)
                    ->limit($limit)
                    ->getWithHasMore();

                return [
                    'scores' => json_collection($highScores->pluck('scoreLink'), $transformer, static::MULTIPLAYER_BASE_INCLUDES),
                    'params' => ['limit' => $limit, 'sort' => $item['cursorHelper']->getSortName()],
                    ...cursor_for_response($item['cursorHelper']->next($highScores, $hasMore)),
                ];
            },
            PlaylistItemUserHighScore::scoresAround($scoreLink),
        ));
    }

    public function includeRankCountry(ScoreBest|SoloScore $score)
    {
        return $this->primitive($score->userRank([
            'type' => 'country',
            'is_legacy' => ScoreSearchParams::showLegacyForUser(\Auth::user()),
        ]));
    }

    public function includeRankGlobal(ScoreBest|SoloScore $score)
    {
        return $this->primitive($score->userRank([
            'is_legacy' => ScoreSearchParams::showLegacyForUser(\Auth::user()),
        ]));
    }

    public function includeUser(LegacyMatch\Score|MultiplayerScoreLink|ScoreModel|SoloScore $score)
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
