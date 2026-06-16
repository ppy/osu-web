// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import * as React from 'react';
import { trans } from 'utils/lang';
import Controller from './controller';
import DailyChallenge from './daily-challenge';
import Matchmaking from './matchmaking';
import MedalsCount from './medals-count';
import PlayTime from './play-time';
import Pp from './pp';
import Rank from './rank';
import RankChart from './rank-chart';
import RankCount from './rank-count';
import Stats from './stats';

interface Props {
  user: Controller['state']['user'];
}

@observer
export default class DetailStats extends React.PureComponent<Props> {
  render() {
    const user = this.props.user;

    if (user.is_bot) return null;

    return (
      <div className='profile-detail-stats'>
        <div>
          <div className='profile-detail-stats__chart-numbers profile-detail-stats__chart-numbers--top'>
            <div className='profile-detail-stats__values'>
              <Rank highest={user.rank_highest} stats={user.statistics} type='global' />
              <Rank stats={user.statistics} type='country' />
            </div>
            <div className='profile-detail-stats__values'>
              <Matchmaking allStats={user.matchmaking_stats} />
              <DailyChallenge stats={user.daily_challenge_user_stats} />
            </div>
          </div>

          <div className='profile-detail-stats__chart'>
            {user.statistics.is_ranked ? (
              <RankChart rankHistory={user.rank_history} stats={user.statistics} />
            ) : (
              <div className='profile-detail-stats__empty-chart'>{trans('users.show.extra.unranked')}</div>
            )}
          </div>
          <div className='profile-detail-stats__chart-numbers'>
            <div className='profile-detail-stats__values profile-detail-stats__values--grid'>
              <MedalsCount userAchievements={user.user_achievements} />
              <Pp stats={user.statistics} />
              <PlayTime stats={user.statistics} />
            </div>
            <div className='profile-detail-stats__values'>
              <RankCount stats={user.statistics} />
            </div>
          </div>
        </div>

        <div className='profile-detail-stats__separator' />

        <Stats stats={user.statistics} />
      </div>
    );
  }
}
