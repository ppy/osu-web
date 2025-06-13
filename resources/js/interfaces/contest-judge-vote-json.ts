// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ContestJudgeScoreJson from './contest-judge-score-json';
import UserJson from './user-json';

export default interface ContestJudgeVoteJson {
  comment: string | null;
  id: number;
  scores?: ContestJudgeScoreJson[];
  total_score?: number;
  total_score_std?: number;
  user?: UserJson;
}

export type ContestJudgeVoteJsonForResults = ContestJudgeVoteJson
& Required<Pick<ContestJudgeVoteJson, 'scores' | 'total_score'>>;
