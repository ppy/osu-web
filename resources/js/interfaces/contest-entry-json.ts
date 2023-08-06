// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ContestJudgeVoteJson from './contest-judge-vote-json';

export default interface ContestEntryJson {
  contest_id: number;
  current_user_judge_vote?: ContestJudgeVoteJson;
  id: number;
  judge_votes?: ContestJudgeVoteJson[];
  results?: {
    actual_name: string;
    votes: number;
  };
  title: string;
  user?: {
    id: number;
    username: string;
  };
}
