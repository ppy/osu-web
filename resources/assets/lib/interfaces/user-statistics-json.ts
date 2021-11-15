// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from './game-mode';

export const grades = ['ssh', 'ss', 'sh', 's', 'a'] as const;
export type Grade = (typeof grades)[number];

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
  grade_counts: Record<Grade, number>;
  level: {
    current: number;
    progress: number;
  };
  play_time: number;
  pp: number;
  variants?: Variant[];
}
