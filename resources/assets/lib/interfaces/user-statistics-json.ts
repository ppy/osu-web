// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from './game-mode';

interface Variant {
  country_rank: number;
  global_rank: number;
  mode: GameMode;
  pp: number;
  variant: string;
}

export default interface UserStatisticsJson {
  global_rank?: number;
  pp: number;
  variants?: Variant[];
}
