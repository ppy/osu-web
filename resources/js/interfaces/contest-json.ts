// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ContestEntryJson from './contest-entry-json';
import ContestScoringCategoryJson from './contest-scoring-category-json';

export default interface ContestJson {
  entries?: ContestEntryJson[];
  id: number;
  max_judging_score?: number;
  name: string;
  scoring_categories?: ContestScoringCategoryJson[];
}
