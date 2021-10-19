// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapExtendedJson from './beatmap-extended-json';
import BeatmapsetJson from './beatmapset-json';
import GameMode from './game-mode';
import Rank from './rank';
import UserJson from './user-json';

export default interface ScoreJson {
  accuracy: number;
  beatmap?: BeatmapExtendedJson;
  beatmapset?: BeatmapsetJson;
  best_id: number | null;
  created_at: string;
  id: number;
  max_combo: number;
  mode?: GameMode;
  mode_int?: number;
  mods: string[];
  passed: boolean;
  pp?: number;
  rank?: Rank;
  rank_country?: number;
  rank_global?: number;
  replay: boolean;
  score: number;
  statistics: {
    count_100: number;
    count_300: number;
    count_50: number;
    count_geki: number;
    count_katu: number;
    count_miss: number;
  };
  user: UserJson;
  user_id: number;
  weight?: {
    percentage: number;
    pp: number;
  };
}
