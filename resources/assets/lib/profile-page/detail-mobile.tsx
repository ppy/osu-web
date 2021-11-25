// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import RankHistoryJson from 'interfaces/rank-history-json';
import UserAchievementJson from 'interfaces/user-achievement-json';
import UserStatisticsJson from 'interfaces/user-statistics-json';
import * as React from 'react';
import MedalsCount from './medals-count';
import PlayTime from './play-time';
import Pp from './pp';
import Rank from './rank';
import RankChart from './rank-chart';

interface Props {
  rankHistory: RankHistoryJson;
  stats: UserStatisticsJson;
  userAchievements: UserAchievementJson[];
}

export default class DetailMobile extends React.PureComponent<Props> {
  render() {
    return (
      <div className='profile-detail-mobile'>
        {this.props.stats.is_ranked &&
          <div className='profile-detail-mobile__item profile-detail-mobile__item--rank-chart'>
            <RankChart
              rankHistory={this.props.rankHistory}
              stats={this.props.stats}
            />
          </div>
        }
        <div className='profile-detail-mobile__item'>
          <Rank stats={this.props.stats} type='global' />
        </div>
        <div className='profile-detail-mobile__item'>
          <Rank stats={this.props.stats} type='country' />
        </div>
        <div className='profile-detail-mobile__item'>
          <PlayTime stats={this.props.stats} />
        </div>
        <div className='profile-detail-mobile__item profile-detail-mobile__item--half'>
          <MedalsCount userAchievements={this.props.userAchievements} />
        </div>
        <div className='profile-detail-mobile__item profile-detail-mobile__item--half'>
          <Pp stats={this.props.stats} />
        </div>
      </div>
    );
  }
}
