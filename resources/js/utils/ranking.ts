// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Ruleset from 'interfaces/ruleset';
import { route } from 'laroute';

const rankingMaxResults = 10000;
const rankingPageSize = 50;

interface PerformanceRankingUrlOptions {
  country?: string | null;
  mode: Ruleset;
  rank?: number | null;
}

export function rankingPageFromRank(rank?: number | null) {
  if (rank == null || !Number.isInteger(rank) || rank < 1 || rank > rankingMaxResults) {
    return null;
  }

  return Math.ceil(rank / rankingPageSize);
}

export function performanceRankingUrl({ country, mode, rank }: PerformanceRankingUrlOptions) {
  const page = rankingPageFromRank(rank);

  return route('rankings', {
    country: country ?? undefined,
    mode,
    page: page ?? undefined,
    type: 'performance',
  });
}
