// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ContestJudgeCategoryJson from './contest-judge-category-json';

export default interface ContestJudgeScoreJson {
  category?: ContestJudgeCategoryJson;
  contest_judge_category_id: number;
  id?: number;
  value: number;
}
