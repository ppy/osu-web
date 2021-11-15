// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from './game-mode';

export type RankType = 'country' | 'global';

interface Variant {
  country_rank: number | null;
  global_rank: number | null;
  mode: GameMode;
  pp: number;
  variant: '4k' | '7k';
}

interface UserStatisticsBaseJson {
  country_rank?: number | null;
  global_rank?: number | null;
  hit_accuracy: number;
  is_ranked: boolean;
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

interface UserStatisticsRankedJson extends UserStatisticsBaseJson {
  country_rank?: number;
  global_rank: number;
  is_ranked: true;
}

interface UserStatisticsUnrankedJson extends UserStatisticsBaseJson {
  country_rank?: null;
  global_rank: null;
  is_ranked: false;
}

type UserStatisticsJson = UserStatisticsRankedJson | UserStatisticsUnrankedJson;

export default UserStatisticsJson;
