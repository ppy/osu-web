// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import ContestJudgeStore from 'stores/contest-judge-store';
import { trans } from 'utils/lang';
import Entry from './entry';

interface Props {
  store: ContestJudgeStore;
}

@observer
export default class Main extends React.Component<Props> {
  @observable private hideJudged = false;

  private get filteredEntries() {
    const entries = [...this.props.store.entries.values()];

    const filteredEntries = this.hideJudged
      ? entries.filter((x) => x.current_user_judge_vote == null)
      : entries;

    return filteredEntries;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    return (
      <div className='contest-judge'>
        <div className='contest-judge__header'>
          {this.renderShowJudgedToggle()}
          {!this.props.store.canJudge && (
            <div>{trans('authorization.contest.judging_not_active')}</div>
          )}
        </div>

        <div className='contest-judge__items'>
          {this.filteredEntries.map((entry) => (
            <Entry
              key={entry.id}
              entry={entry}
              store={this.props.store}
            />
          ))}
        </div>
      </div>
    );
  }

  private renderShowJudgedToggle() {
    return (
      <label className='contest-judge__switch'>
        <div className='osu-switch-v2'>
          <input
            checked={this.hideJudged}
            className='osu-switch-v2__input'
            onChange={this.toggleShowJudged}
            type='checkbox'
          />
          <span className='osu-switch-v2__content' />
        </div>
        {trans('contest.judge.hide_judged')}
      </label>
    );
  }

  @action
  private readonly toggleShowJudged = () => {
    this.hideJudged = !this.hideJudged;
  };
}
