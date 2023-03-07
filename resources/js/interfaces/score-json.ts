// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapExtendedJson from './beatmap-extended-json';
import BeatmapsetJson from './beatmapset-json';
import GameMode from './game-mode';
import Rank from './rank';
import UserJson from './user-json';

export interface ScoreCurrentUserPinJson {
  is_pinned: boolean;
  score_id: number;
  score_type: `score_best_${GameMode}` | 'solo_score';
}

export type ScoreStatisticsAttribute = 'count_50' | 'count_100' | 'count_300' | 'count_geki' | 'count_katu' | 'count_miss';

interface ScoreCurrentUserAttributesJson {
  pin?: ScoreCurrentUserPinJson;
}

interface Match {
  pass: boolean;
  slot: number;
  team: number;
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
  mode: GameMode;
  mode_int: number;
  mods: string[];
  passed: boolean;
  perfect: boolean;
  pp: number | null;
  rank: Rank;
  replay: boolean;
  score: number;
  statistics: Record<ScoreStatisticsAttribute, number>;
  type: 'solo_score' | `score_best_${GameMode}` | `score_${GameMode}`;
  user_id: number;
}

type ScoreJson = ScoreJsonDefaultAttributes & ScoreJsonDefaultIncludes & Partial<ScoreJsonAvailableIncludes>;

export default ScoreJson;
