// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import MatchmakingPoolJson from './matchmaking-pool-json';

interface MatchmakingUserStatsJsonAvailableIncludes {
  pool: MatchmakingPoolJson;
}

interface MatchmakingUserStatsJsonDefaultAttributes {
  first_placements: number;
  pool_id: number;
  rank: number;
  rating: number;
  total_points: number;
  user_id: number;
}

type MatchmakingUserStatsJson = MatchmakingUserStatsJsonDefaultAttributes & Partial<MatchmakingUserStatsJsonAvailableIncludes>;

export default MatchmakingUserStatsJson;
