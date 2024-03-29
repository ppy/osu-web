// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserAvatar from 'components/user-avatar';
import UserLink from 'components/user-link';
import ValueDisplay from 'components/value-display';
import { ContestJsonForResults } from 'interfaces/contest-json';
import { ContestJudgeVoteJsonForResults } from 'interfaces/contest-judge-vote-json';
import * as React from 'react';
import { trans } from 'utils/lang';

interface Props {
  contest: ContestJsonForResults;
  vote: ContestJudgeVoteJsonForResults;
}

export default function Vote(props: Props) {
  return (
    <div>
      {props.vote.user != null && (
        <div className='contest-judge-results-vote__user'>
          <UserLink className='contest-judge-results-vote__avatar' user={props.vote.user}>
            <UserAvatar modifiers='full-circle' user={props.vote.user} />
          </UserLink>

          <UserLink className='contest-judge-results-vote__username' user={props.vote.user} />
        </div>
      )}

      <div className='contest-judge-results-vote__total-score'>
        <ValueDisplay
          label={trans('contest.judge_results.score')}
          modifiers={'score'}
          value={`${props.vote.total_score}/${props.contest.max_judging_score}`}
        />
      </div>

      <div className='contest-judge-results-scores'>
        {props.vote.scores.map((score) => {
          const category = props.contest.scoring_categories.find((x) => x.id === score.contest_scoring_category_id);

          return (
            <div key={score.id} className='contest-judge-results-scores__row'>
              <div className='contest-judge-results-scores__col'>
                <div className='contest-judge-entry__description-icon' title={category?.description}>
                  <i className='fas fa-question-circle' />
                </div>

                <span className='u-ellipsis-overflow'>{category?.name}</span>
              </div>
              <div className='contest-judge-results-scores__col contest-judge-results-scores__col--score'>
                {score.value}/{category?.max_value}
              </div>
            </div>
          );
        })}
      </div>

      {props.vote.comment != null && <div className='contest-judge-results-vote__comment'>{props.vote.comment}</div>}
    </div>
  );
}
