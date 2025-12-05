// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import * as React from 'react';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';
import { ProfilePageMatchmakingStatsJson } from './extra-page-props';

interface Props {
  allStats: ProfilePageMatchmakingStatsJson[];
}

@observer
export default class Matchmaking extends React.Component<Props> {
  render() {
    let highestRank: null | number = null;
    for (const stats of this.props.allStats) {
      const rank = stats.rank;
      if (rank != null) {
        if (highestRank == null) {
          highestRank = rank;
        } else if (rank < highestRank) {
          highestRank = rank;
        }
      }
    }

    return (
      <div className='daily-challenge' title={trans('users.show.matchmaking.details_soon')}>
        <div className='daily-challenge__name'>
          {trans('users.show.matchmaking.title')}
        </div>
        <div className='daily-challenge__value-box'>
          <div className='daily-challenge__value'>
            {highestRank == null ? '-' : `#${formatNumber(highestRank)}`}
          </div>
        </div>
      </div>
    );
  }
}
