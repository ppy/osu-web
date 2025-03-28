// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import SeasonDivisionJson from './season-division-json';
import SeasonJson from './season-json';

export default interface SeasonStatsJson {
  division: SeasonDivisionJson;
  rank: number;
  season: SeasonJson;
  total_score: number;
}
