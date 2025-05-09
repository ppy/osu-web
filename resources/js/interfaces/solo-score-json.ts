// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapExtendedJson from './beatmap-extended-json';
import Rank from './rank';
import Ruleset from './ruleset';
import { ScoreJsonAvailableIncludes, ScoreJsonDefaultIncludes } from './score-json';
import ScoreModJson from './score-mod-json';
import WithBeatmapOwners from './with-beatmap-owners';

export type SoloScoreStatisticsAttribute =
  | 'combo_break'
  | 'good'
  | 'great'
  | 'ignore_hit'
  | 'ignore_miss'
  | 'large_bonus'
  | 'large_tick_hit'
  | 'large_tick_miss'
  | 'legacy_combo_increase'
  | 'meh'
  | 'miss'
  | 'ok'
  | 'perfect'
  | 'slider_tail_hit'
  | 'small_bonus'
  | 'small_tick_hit'
  | 'small_tick_miss';

interface SoloScoreJsonAttributesBase {
  accuracy: number;
  beatmap_id: number;
  best_id: number | null;
  build_id: number | null;
  ended_at: string;
  has_replay: boolean;
  id: number;
  is_perfect_combo: boolean;
  legacy_perfect: boolean;
  legacy_score_id: number | null;
  legacy_total_score: number;
  max_combo: number;
  maximum_statistics: Partial<Record<SoloScoreStatisticsAttribute, number>>;
  mods: ScoreModJson[];
  passed: boolean;
  pp: number | null;
  rank: Rank;
  ruleset_id: number;
  started_at: string | null;
  statistics: Partial<Record<SoloScoreStatisticsAttribute, number>>;
  total_score: number;
  total_score_without_mods?: number;
  user_id: number;
}

interface SoloScoreJsonAttributesLegacy extends SoloScoreJsonAttributesBase {
  type: `score_best_${Ruleset}` | `score_${Ruleset}`;
}

interface SoloScoreJsonAttributesSoloScore extends SoloScoreJsonAttributesBase {
  classic_total_score: number;
  preserve: boolean;
  processed: boolean;
  ranked: boolean;
  type: 'solo_score';
}

interface SoloScoreJsonAttributesMultiplayer extends SoloScoreJsonAttributesSoloScore {
  playlist_item_id: number;
  room_id: number;
  solo_score_id: number;
}

type SoloScoreJsonAttributes = SoloScoreJsonAttributesLegacy | SoloScoreJsonAttributesMultiplayer | SoloScoreJsonAttributesSoloScore;

type SoloScoreJson = SoloScoreJsonAttributes & ScoreJsonDefaultIncludes & Partial<ScoreJsonAvailableIncludes>;

export default SoloScoreJson;

export type SoloScoreJsonForBeatmap = SoloScoreJson & Required<Pick<SoloScoreJson, 'user'>>;

export type SoloScoreJsonForShow = SoloScoreJson
& Required<Pick<SoloScoreJson, 'beatmapset' | 'best_id' | 'rank_global' | 'user'>>
& {
  beatmap: WithBeatmapOwners<BeatmapExtendedJson>;
};

export type SoloScoreJsonForUser = SoloScoreJson & Required<Pick<SoloScoreJson, 'beatmap' | 'beatmapset'>>;

export function isSoloScoreJsonForUser(score: SoloScoreJson): score is SoloScoreJsonForUser {
  return score.beatmap != null && score.beatmapset != null;
}
