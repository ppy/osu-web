// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapExtendedJson from './beatmap-extended-json';
import BeatmapsetJson from './beatmapset-json';
import Rank from './rank';
import { RulesetId } from './ruleset';
import ScoreModJson from './score-mod-json';
import UserJson from './user-json';
import WithBeatmapOwners from './with-beatmap-owners';

export interface ScoreCurrentUserPinJson {
  is_pinned: boolean;
  score_id: number;
}

export type ScoreStatisticsAttribute =
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

interface Match {
  pass: boolean;
  slot: number;
  team: 'blue' | 'none' | 'red';
}

interface PpWeight {
  percentage: number;
  pp: number;
}

interface ScoreJsonAttributesLegacyMatch {
  type: 'legacy_match_score';
}

interface ScoreJsonAttributesSolo {
  classic_total_score: number;
  preserve: boolean;
  processed: boolean;
  ranked: boolean;
  type: 'solo_score';
}

interface ScoreJsonAttributesMultiplayer extends ScoreJsonAttributesSolo {
  playlist_item_id: number;
  room_id: number;
  solo_score_id: number;
}

type ScoreJsonAttributes = {
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
  maximum_statistics: Partial<Record<ScoreStatisticsAttribute, number>>;
  mods: ScoreModJson[];
  passed: boolean;
  pp: number | null;
  rank: Rank;
  ruleset_id: RulesetId;
  started_at: string | null;
  statistics: Partial<Record<ScoreStatisticsAttribute, number>>;
  total_score: number;
  total_score_without_mods?: number;
  user_id: number;
} & (ScoreJsonAttributesLegacyMatch | ScoreJsonAttributesSolo | ScoreJsonAttributesMultiplayer);

export interface ScoreJsonDefaultIncludes {
  current_user_attributes: {
    pin?: ScoreCurrentUserPinJson;
  };
}

export interface ScoreJsonAvailableIncludes {
  beatmap: BeatmapExtendedJson;
  beatmapset: BeatmapsetJson;
  match: Match;
  rank_country: number;
  rank_global: number;
  user: UserJson;
  weight: PpWeight;
}

type ScoreJson = ScoreJsonAttributes & ScoreJsonDefaultIncludes & Partial<ScoreJsonAvailableIncludes>;

export default ScoreJson;

export type ScoreJsonForBeatmap = ScoreJson & Required<Pick<ScoreJson, 'user'>>;

export type ScoreJsonForShow = ScoreJson
& Required<Pick<ScoreJson, 'beatmapset' | 'rank_global' | 'user'>>
& {
  beatmap: WithBeatmapOwners<BeatmapExtendedJson>;
  type: 'solo_score';
};

export type ScoreJsonForUser = ScoreJson & Required<Pick<ScoreJson, 'beatmap' | 'beatmapset'>>;

export type ScoreJsonForTopPlays = ScoreJson & Required<Pick<ScoreJson, 'beatmap' | 'beatmapset' | 'user'>>;

export function isScoreJsonForUser(score: ScoreJson): score is ScoreJsonForUser {
  return score.beatmap != null && score.beatmapset != null;
}

export type LegacyMatchScoreJson = ScoreJson & Required<Pick<ScoreJson, 'match'>>;
