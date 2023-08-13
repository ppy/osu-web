// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BasicSelectOptions from 'components/basic-select-options';
import UserLink from 'components/user-link';
import ValueDisplay from 'components/value-display';
import ContestEntryJson from 'interfaces/contest-entry-json';
import ContestJson from 'interfaces/contest-json';
import SelectOptionJson from 'interfaces/select-option-json';
import * as React from 'react';
import { trans } from 'utils/lang';

interface Props {
  contest: ContestJson;
  entries: ContestEntryJson[];
  entry: ContestEntryJson;
}

export default class Header extends React.PureComponent<Props> {
  get selectOptions(): SelectOptionJson[] {
    const ret = [];

    for (const entry of this.props.entries) {
      ret.push(this.entryToSelectOption(entry));
    }

    return ret;
  }

  entryToSelectOption(entry: ContestEntryJson): SelectOptionJson {
    return {
      id: entry.id,
      text: entry.title,
    };
  }

  render() {
    const { contest, entry } = this.props;

    const score = entry.results?.votes;
    const maxScore = (contest.max_judging_score ?? 0) * (entry.judge_votes?.length ?? 0);
    const totalScore = `${score}/${maxScore}`;

    const userLink = this.renderUserLink();

    return (
      <div className='contest-judge-results-header'>
        <BasicSelectOptions
          currentItem={this.entryToSelectOption(this.props.entry)}
          items={this.selectOptions}
          type='judge_results'
        />

        <div className='contest-judge-results-header__values'>
          {score != null && <ValueDisplay
            label={trans('contest.judge_results.total_score')}
            modifiers={['judge-results']}
            value={totalScore}
          />}

          {userLink != null && <ValueDisplay
            label={trans('contest.judge_results.creator')}
            modifiers={['judge-results']}
            value={userLink}
          />}
        </div>
      </div>
    );
  }

  renderUserLink() {
    const { user } = this.props.entry;
    if (user == null) return;

    return (
      <UserLink user={user} />
    );
  }
}
