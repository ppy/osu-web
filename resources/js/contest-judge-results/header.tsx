// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BasicSelectOptions from 'components/basic-select-options';
import UserLink from 'components/user-link';
import ValueDisplay from 'components/value-display';
import { ContestEntryJsonForResults } from 'interfaces/contest-entry-json';
import { ContestJsonForResults } from 'interfaces/contest-json';
import SelectOptionJson from 'interfaces/select-option-json';
import * as React from 'react';
import { trans } from 'utils/lang';

interface Props {
  contest: ContestJsonForResults;
  entries: ContestEntryJsonForResults[];
  entry: ContestEntryJsonForResults;
}

export default class Header extends React.PureComponent<Props> {
  private get selectOptions(): SelectOptionJson[] {
    const ret = [];

    for (const entry of this.props.entries) {
      ret.push(this.entryToSelectOption(entry));
    }

    return ret;
  }

  render() {
    const totalScore = `${this.props.entry.results.votes}/${this.props.contest.max_total_score}`;

    return (
      <div className='contest-judge-results-header'>
        <BasicSelectOptions
          currentItem={this.entryToSelectOption(this.props.entry)}
          items={this.selectOptions}
          type='judge_results'
        />

        <div className='contest-judge-results-header__values'>
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

  private entryToSelectOption(entry: ContestEntryJsonForResults): SelectOptionJson {
    return {
      id: entry.id,
      text: entry.title,
    };
  }
}
