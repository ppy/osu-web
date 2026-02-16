// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'components/header-v4';
import { ContestEntryJsonForResults } from 'interfaces/contest-entry-json';
import { ContestJsonForResults } from 'interfaces/contest-json';
import { route } from 'laroute';
import { observer } from 'mobx-react';
import * as React from 'react';
import { trans } from 'utils/lang';
import Header from './header';
import State from './state';
import Vote from './vote';

interface Props {
  container: HTMLElement;
  contest: ContestJsonForResults;
  entries: ContestEntryJsonForResults[];

}
@observer
export default class Main extends React.Component<Props> {
  private readonly resultsState = new State(this.props.contest, this.props.entries, this.props.container);

  render() {
    const selectedEntry = this.resultsState.selected;
    const links = [
      { title: trans('contest.index.nav_title'), url: route('contests.index') },
      { title: trans('contest.index.nav_title'), url: route('contests.show', { contest: this.resultsState.contest.id }) },
      {
        title: `${selectedEntry.title} (${selectedEntry.user.username})`,
        url: route('contests.entries.judge-results', { contest: this.resultsState.contest.id, contest_entry: selectedEntry.id }),
      },
    ];

    return (
      <>
        <HeaderV4 links={links} linksBreadcrumb theme='contests' />
        <div className='osu-page'>
          <Header state={this.resultsState} />
          <div className='contest-judge-results'>
            {selectedEntry.judge_votes.map((vote) => (
              <Vote
                key={vote.id}
                contest={this.resultsState.contest}
                vote={vote}
              />
            ))}
          </div>
        </div>
      </>
    );
  }
}
