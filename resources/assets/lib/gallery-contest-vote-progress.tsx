// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { CircularProgress } from 'circular-progress';
import * as React from 'react';

type Props = Record<string, never>;

interface State {
  maxVotes: number;
  votesLeft: number;
}

export default class GalleryContestVoteProgress extends React.PureComponent<Props, State> {
  constructor(props: Props) {
    super(props);

    this.state = this.getVoteState();
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
          current={this.state.votesLeft}
          max={this.state.maxVotes}
          reverse
          theme='gallery-contest'
          tooltip={osu.transChoice('contest.voting.progress._', this.state.votesLeft)}
        />
      </div>
    );
  }

  private getVoteState = () => {
    const voteSummary = this.voteSummary();
    const data: State | null = JSON.parse(voteSummary.dataset.contestVoteSummary ?? 'null');

    return {
      maxVotes: data?.maxVotes ?? 0,
      votesLeft: data?.votesLeft ?? 0,
    };
  };

  private syncState = () => {
    this.setState(this.getVoteState());
  };

  private voteSummary = () => {
    const contestVoteSummary = document.querySelector('.js-contest-vote-summary');

    if (contestVoteSummary instanceof HTMLElement) {
      return contestVoteSummary;
    }

    throw new Error('.js-contest-vote-summary is not HTMLElement');
  };
}
