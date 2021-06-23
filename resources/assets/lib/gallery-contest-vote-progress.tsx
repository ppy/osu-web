// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { CircularProgress } from 'circular-progress';
import * as React from 'react';

type Props = Record<string, never>;

interface State {
  voteLeft: number;
}

export default class GalleryContestVoteProgress extends React.PureComponent<Props, State> {
  constructor(props: Props) {
    super(props);

    this.state = {
      voteLeft: this.getVoteLeft(),
    };
  }

  componentDidMount() {
    $.subscribe('contest:vote:end.count', this.syncState);
  }

  componentWillUnmount() {
    $.unsubscribe('.count');
  }

  render() {
    return (
      <div className='pswp__button pswp__button--vote-progress'>
        <CircularProgress
          current={this.state.voteLeft}
          max={this.getMaxVotes()}
          reverse
          theme='gallery-contest'
          tooltip={osu.transChoice('contest.voting.progress._', this.state.voteLeft)}
        />
      </div>
    );
  }

  private getMaxVotes = () => {
    const voteSummary = this.voteSummary();
    return parseInt(voteSummary.dataset.contestMaxVotes ?? '0', 10);
  };

  private getVoteLeft = () => {
    const maxVotes = this.getMaxVotes();

    const voteSummary = this.voteSummary();
    const voteCount = parseInt(voteSummary.dataset.contestVoteCount ?? '0', 10);

    return maxVotes - voteCount;
  };

  private syncState = () => {
    this.setState({ voteLeft: this.getVoteLeft() });
  };

  private voteSummary = () => document.querySelector('.js-contest-vote-summary') as HTMLElement;
}
