// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { CircularProgress } from 'circular-progress';
import * as React from 'react';

type Props = Record<string, never>;

interface State {
  maxVotes: number;
  voteCount: number;
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
          current={this.state.voteCount}
          max={this.state.maxVotes}
          reverse
          theme='gallery-contest'
          tooltip={osu.transChoice('contest.voting.progress._', this.state.voteCount)}
        />
      </div>
    );
  }

  private getVoteState = () => {
    const voteSummary = this.voteSummary();
    const data = voteSummary.dataset.contestVoteSummary;

    if (data === undefined) {
      return { maxVotes: 0, voteCount: 0 };
    }

    const voteState: State = JSON.parse(data);
    return voteState;
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
