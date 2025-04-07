// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapExtendedJson from './beatmap-extended-json';
import BeatmapsetJson from './beatmapset-json';
import Rank from './rank';
import Ruleset from './ruleset';
import UserJson from './user-json';

export interface ScoreCurrentUserPinJson {
  is_pinned: boolean;
  score_id: number;
}

export type ScoreStatisticsAttribute = 'count_50' | 'count_100' | 'count_300' | 'count_geki' | 'count_katu' | 'count_miss';

interface ScoreCurrentUserAttributesJson {
  pin?: ScoreCurrentUserPinJson;
}

export interface Match {
  pass: boolean;
  slot: number;
  team: 'blue' | 'none' | 'red';
}

interface PpWeight {
  percentage: number;
  pp: number;
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

export interface ScoreJsonDefaultIncludes {
  current_user_attributes: ScoreCurrentUserAttributesJson;
}

interface ScoreJsonDefaultAttributes {
  accuracy: number;
  best_id: number | null;
  created_at: string;
  id: number;
  max_combo: number;
  mode: Ruleset;
  mode_int: number;
  mods: string[];
  passed: boolean;
  perfect: boolean;
  pp: number | null;
  rank: Rank;
  replay: boolean;
  score: number;
  statistics: Record<ScoreStatisticsAttribute, number>;
  type: 'legacy_match_score' | 'solo_score' | `score_best_${Ruleset}` | `score_${Ruleset}`;
  user_id: number;
}

type ScoreJson = ScoreJsonDefaultAttributes & ScoreJsonDefaultIncludes & Partial<ScoreJsonAvailableIncludes>;

export default ScoreJson;
