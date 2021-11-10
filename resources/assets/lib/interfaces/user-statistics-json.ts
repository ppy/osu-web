// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from 'interfaces/game-mode';

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
  level: {
    current: number;
    progress: number;
  };
  variants?: Variant[];
}
