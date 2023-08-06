// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ContestJudgeCategoryVoteJson from './contest-judge-category-vote-json';
import UserJson from './user-json';

export default interface ContestJudgeVoteJson {
  category_votes?: ContestJudgeCategoryVoteJson[];
  comment: string | null;
  id: number;
  score?: number;
  user?: UserJson;
}
