// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ContestJudgeVoteJson, { ContestJudgeVoteJsonForResults } from './contest-judge-vote-json';

interface ContestEntryJsonAvailableIncludes {
  current_user_judge_vote: ContestJudgeVoteJson;
  judge_votes: ContestJudgeVoteJson[];
  results: {
    actual_name: string;
    score_std: number | null;
    votes: number;
  };
  user: {
    id: number;
    username: string;
  };
}

interface ContestEntryJsonDefaultAttributes {
  contest_id: number;
  id: number;
  title: string;
}

type ContestEntryJson = ContestEntryJsonDefaultAttributes
& Partial<ContestEntryJsonAvailableIncludes>;
export default ContestEntryJson;

export type ContestEntryJsonForResults = ContestEntryJsonDefaultAttributes
& Required<Pick<ContestEntryJsonAvailableIncludes, 'results' | 'user'>>
& {
  judge_votes: ContestJudgeVoteJsonForResults[];
};
