// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import SelectOptions, { OptionRenderProps } from 'components/select-options';
import UserLink from 'components/user-link';
import ValueDisplay from 'components/value-display';
import ContestEntryJson from 'interfaces/contest-entry-json';
import ContestJson from 'interfaces/contest-json';
import SelectOptionJson from 'interfaces/select-option-json';
import { route } from 'laroute';
import * as React from 'react';
import { navigate } from 'utils/turbolinks';

interface Props {
  contest: ContestJson;
  entries: ContestEntryJson[];
  entry: ContestEntryJson;
}

export default class Header extends React.PureComponent<Props> {
  get selected() {
    return {
      id: this.props.entry.id,
      text: this.props.entry.title,
    };
  }

  get selectOptions() {
    const ret = [];

    for (const x of this.props.entries) {
      ret.push({ id: x.id, text: x.title });
    }

    return ret;
  }

  render() {
    const { contest, entry } = this.props;

    const score = entry.results?.votes;
    const maxScore = (contest.max_judging_score ?? 0) * (entry.judge_votes?.length ?? 0);
    const totalScore = `${score}/${maxScore}`;

    const userLink = this.renderUserLink();

    return (
      <div className='contest-judge-results-header'>
        {this.renderSelectOptions()}

        <div className='contest-judge-results-header__values'>
          {score != null && <ValueDisplay
            label='total score'
            modifiers={['judge-results']}
            value={totalScore}
          />}

          {userLink && <ValueDisplay
            label='creator'
            modifiers={['judge-results']}
            value={userLink}
          />}
        </div>
      </div>
    );
  }

  renderSelectOptions() {
    return (
      <SelectOptions
        modifiers='judge-results'
        onChange={this.handleChange}
        options={this.selectOptions}
        renderOption={this.renderOption}
        selected={this.selected}
      />
    );
  }

  renderUserLink() {
    const { user } = this.props.entry;
    if (user == null) return;

    return (
      <UserLink user={user} />
    );
  }

  private handleChange = (option: SelectOptionJson) => {
    navigate(this.href(option.id));
  };

  private href(id: number) {
    return route('contest-entries.judge-results', { contest_entry: id });
  }

  private renderOption = (props: OptionRenderProps<SelectOptionJson>) => (
    <a
      key={props.option.id}
      className={props.cssClasses}
      href={this.href(props.option.id)}
      onClick={props.onClick}
    >
      {props.children}
    </a>
  );
}
