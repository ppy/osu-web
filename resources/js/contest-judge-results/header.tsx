// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import SelectOptions, { OptionRenderProps } from 'components/select-options';
import UserLink from 'components/user-link';
import ValueDisplay from 'components/value-display';
import { ContestEntryJsonForResults } from 'interfaces/contest-entry-json';
import { route } from 'laroute';
import { action, computed } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';
import State from './state';

interface Option {
  contest_id: ContestEntryJsonForResults['contest_id'];
  id: ContestEntryJsonForResults['id'];
  text: ContestEntryJsonForResults['title'];
}

interface Props {
  state: State;
}

function entryToOption(entry: ContestEntryJsonForResults) {
  return {
    contest_id: entry.contest_id,
    id: entry.id,
    text: `${entry.title} (${entry.user.username})`,
  };
}

@observer
export default class Header extends React.Component<Props> {
  @computed
  private get options() {
    return this.props.state.entries.map(entryToOption);
  }

  render() {
    const selectedEntry = this.props.state.selected;
    const totalScore = `${selectedEntry.results.votes}/${this.props.state.contest.max_total_score}`;
    const totalScoreStd = selectedEntry.results.score_std;

    return (
      <div className='contest-judge-results-header'>
        <SelectOptions
          onChange={this.handleChange}
          options={this.options}
          renderOption={this.renderOption}
          selected={entryToOption(selectedEntry)}
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
              <UserLink user={selectedEntry.user} />
            }
          />
        </div>
      </div>
    );
  }

  @action
  private readonly handleChange = (option: Option) => {
    this.props.state.select(option.id);
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
