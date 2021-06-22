// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { CircularProgress } from 'circular-progress';
import * as React from 'react';

export default class GalleryContestVoteProgress extends React.PureComponent {
  render() {
    return (
      <div className='pswp__button pswp__button--vote-progress'>
        <CircularProgress current={this.getVoteCount()} max={this.getMaxVotes()} />
      </div>
    );
  }

  private getMaxVotes = () => {
    const voteSummary = this.voteSummary();
    return parseInt(voteSummary.dataset.contestMaxVotes ?? '0', 10);
  };

  private getVoteCount = () => {
    const voteSummary = this.voteSummary();
    return parseInt(voteSummary.dataset.contestVoteCount ?? '0', 10);
  };

  private voteSummary = () => document.querySelector('.js-contest-vote-summary') as HTMLElement;

}
