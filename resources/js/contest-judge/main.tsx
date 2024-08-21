// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import ContestJudgeStore from 'stores/contest-judge-store';
import { classWithModifiers } from 'utils/css';
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
      <>
        <div className='contest-judge contest-judge--header'>
          {this.renderShowJudgedToggle()}
        </div>

        <div className='contest-judge contest-judge--items'>
          {this.filteredEntries.map((entry) => (
            <Entry
              key={entry.id}
              entry={entry}
              store={this.props.store}
            />
          ))}
        </div>
      </>
    );
  }

  private renderShowJudgedToggle() {
    const iconClass = this.hideJudged
      ? 'fas fa-check-square'
      : 'far fa-square';

    return (
      <button
        className={classWithModifiers('sort__item', ['button', 'contest-judge'])}
        onClick={this.toggleShowJudged}
        type='button'
      >
        <span className='sort__item-icon'>
          <span className={iconClass} />
        </span>

        {trans('contest.judge.hide_judged')}
      </button>
    );
  }

  @action
  private readonly toggleShowJudged = () => {
    this.hideJudged = !this.hideJudged;
  };
}
