// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ContestScoringCategoryJson from './contest-scoring-category-json';

export default interface ContestJudgeScoreJson {
  category?: ContestScoringCategoryJson;
  contest_scoring_category_id: number;
  id?: number;
  value: number;
}
