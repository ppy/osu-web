// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import SelectOptions, { OptionRenderProps } from 'components/select-options';
import UserLink from 'components/user-link';
import ValueDisplay from 'components/value-display';
import { ContestEntryJsonForResults } from 'interfaces/contest-entry-json';
import { ContestJsonForResults } from 'interfaces/contest-json';
import { route } from 'laroute';
import { computed } from 'mobx';
import * as React from 'react';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';
import { navigate } from 'utils/turbolinks';

interface Option {
  contest_id: ContestEntryJsonForResults['contest_id'];
  id: ContestEntryJsonForResults['id'];
  text: ContestEntryJsonForResults['title'];
}

interface Props {
  contest: ContestJsonForResults;
  entries: ContestEntryJsonForResults[];
  entry: ContestEntryJsonForResults;
}

function entryToOption(entry: ContestEntryJsonForResults) {
  return {
    contest_id: entry.contest_id,
    id: entry.id,
    text: `${entry.title} (${entry.user.username})`,
  };
}

export default class Header extends React.PureComponent<Props> {
  @computed
  private get options() {
    return this.props.entries.map(entryToOption);
  }

  render() {
    const totalScore = `${this.props.entry.results.votes}/${this.props.contest.max_total_score}`;
    const totalScoreStd = this.props.entry.results.score_std;

    return (
      <div className='contest-judge-results-header'>
        <SelectOptions
          onChange={this.handleChange}
          options={this.options}
          renderOption={this.renderOption}
          selected={entryToOption(this.props.entry)}
        />

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

  private readonly handleChange = (option: Option) => {
    navigate(route('contests.entries.judge-results', { contest: option.contest_id, contest_entry: option.id }));
  };

  private readonly renderOption = ({ cssClasses, children, onClick, option }: OptionRenderProps<Option>) => (
    <a
      key={option.id}
      className={cssClasses}
      href={route('contests.entries.judge-results', { contest: option.contest_id, contest_entry: option.id })}
      onClick={onClick}
    >
      {children}
    </a>
  );
}
