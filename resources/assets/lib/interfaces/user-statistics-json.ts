// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from './game-mode';

export type RankType = 'country' | 'global';

interface Variant {
  country_rank?: number;
  global_rank?: number;
  mode: GameMode;
  pp: number;
  variant: '4k' | '7k';
}

export default interface UserStatisticsJson {
  country_rank?: number;
  global_rank?: number;
  hit_accuracy: number;
  maximum_combo: number;
  level: {
    current: number;
    progress: number;
  };
  play_count: number;
  play_time: number;
  pp: number;
  ranked_score: number;
  replays_watched_by_others: number;
  total_hits: number;
  total_score: number;
  variants?: Variant[];
}
