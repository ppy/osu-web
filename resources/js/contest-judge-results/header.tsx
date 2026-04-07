// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import SelectOptions from 'components/select-options';
import UserLink from 'components/user-link';
import ValueDisplay from 'components/value-display';
import { ContestEntryJsonForResults } from 'interfaces/contest-entry-json';
import { ContestJsonForResults } from 'interfaces/contest-json';
import { route } from 'laroute';
import * as React from 'react';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';

interface Props {
  contest: ContestJsonForResults;
  entries: ContestEntryJsonForResults[];
  entry: ContestEntryJsonForResults;
}

function entryToOption(entry: ContestEntryJsonForResults) {
  return {
    children: <OptionText entry={entry} />,
    href: route('contests.entries.judge-results', { contest: entry.contest_id, contest_entry: entry.id }),
    id: entry.id,
  };
}

function OptionText(props: { entry: ContestEntryJsonForResults }) {
  return (
    <ValueDisplay label={props.entry.title} modifiers='select-option' value={props.entry.user.username} />
  );
}

export default class Header extends React.PureComponent<Props> {
  private get options() {
    return this.props.entries.map(entryToOption);
  }

  render() {
    const totalScore = `${this.props.entry.results.votes}/${this.props.contest.max_total_score}`;
    const totalScoreStd = this.props.entry.results.score_std;

    return (
      <div className='contest-judge-results-header'>
        <SelectOptions
          href={this.href(this.props.entry.id)}
          modifiers='ranking'
          options={this.options}
          selected={this.props.entry.id}
        >
          <OptionText entry={this.props.entry} />
        </SelectOptions>

        <div className='contest-judge-results-header__values'>
          {totalScoreStd != null && (
            <ValueDisplay
              label={trans('contest.judge_results.total_score_std')}
              modifiers='judge-results'
              value={formatNumber(totalScoreStd, 2)}
            />
          )}

          <ValueDisplay
            label={trans('contest.judge_results.total_score')}
            modifiers='judge-results'
            value={totalScore}
          />

          <ValueDisplay
            label={trans('contest.judge_results.creator')}
            modifiers='judge-results'
            value={
              <UserLink user={this.props.entry.user} />
            }
          />
        </div>
      </div>
    );
  }

  private href(entryId?: number) {
    return route('contests.entries.judge-results', { contest: this.props.contest.id, contest_entry: entryId });
  }
}
