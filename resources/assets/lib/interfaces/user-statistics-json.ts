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
  grade_counts: {
    a: number;
    s: number;
    sh: number;
    ss: number;
    ssh: number;
  };
  hit_accuracy: number;
  level: {
    current: number;
    progress: number;
  };
  maximum_combo: number;
  play_count: number;
  play_time: number;
  pp: number;
  ranked_score: number;
  replays_watched_by_others: number;
  total_hits: number;
  total_score: number;
  variants?: Variant[];
}
