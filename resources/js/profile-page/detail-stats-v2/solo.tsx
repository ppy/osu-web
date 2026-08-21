// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import Controller from 'profile-page/controller';
import MedalsCount from 'profile-page/medals-count';
import Pp from 'profile-page/pp';
import Rank from 'profile-page/rank';
import RankChart from 'profile-page/rank-chart';
import RankCount from 'profile-page/rank-count';
import * as React from 'react';
import { trans } from 'utils/lang';

interface Props {
  controller: Controller;
}

@observer
export default class Solo extends React.PureComponent<Props> {
  render() {
    const user = this.props.controller.state.user;

    return (
      <div className='profile-detail-stats-card profile-detail-stats-card--solo'>
        <div className='profile-detail-stats-card__top'>
          <div className='profile-detail-stats-card__title'>
            <div className='profile-detail-stats-card__title-icon'>
              <span className='svg-icon svg-icon--solo' />
            </div>
            <div>
              {trans('users.show.solo.title')}
            </div>
          </div>
          <div className='profile-detail-stats-card__values'>
            <Rank highest={user.rank_highest} stats={user.statistics} type='global' />
            <Rank modifiers='rank-small' plainValue stats={user.statistics} type='country' />
          </div>
          <div className='profile-detail-stats-card__values profile-detail-stats-card__values--row'>
            <Pp stats={user.statistics} />
            <MedalsCount userAchievements={user.user_achievements} />
          </div>
        </div>

        <div className='profile-detail-stats-card__middle'>
          <RankCount modifiers='v2' stats={user.statistics} />
        </div>

        <div className='profile-detail-stats-card__bottom'>
          {user.statistics.is_ranked
            ? (
              <div className='profile-detail-stats-card__chart'>
                <RankChart rankHistory={user.rank_history} stats={user.statistics} />
              </div>
            ) : (
              <div className='profile-detail-stats-card__empty-chart'>
                {trans('users.show.extra.unranked')}
              </div>
            )
          }
        </div>
        <div className='profile-detail-stats-card__decor-corner' />
        <div className='profile-detail-stats-card__decor' />
      </div>
    );
  }
}
