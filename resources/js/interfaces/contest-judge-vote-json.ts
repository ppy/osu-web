// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ContestJudgeScoreJson from './contest-judge-score-json';
import UserJson from './user-json';

export default interface ContestJudgeVoteJson {
  comment: string | null;
  id: number;
  score?: number;
  scores?: ContestJudgeScoreJson[];
  user?: UserJson;
}
