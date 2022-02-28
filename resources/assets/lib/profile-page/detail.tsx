// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ProfileTournamentBanner from 'components/profile-tournament-banner';
import { observer } from 'mobx-react';
import Badges from 'profile-page/badges';
import Cover from 'profile-page/cover';
import DetailBar from 'profile-page/detail-bar';
import MedalsCount from 'profile-page/medals-count';
import PlayTime from 'profile-page/play-time';
import Pp from 'profile-page/pp';
import Rank from 'profile-page/rank';
import RankChart from 'profile-page/rank-chart';
import RankCount from 'profile-page/rank-count';
import Stats from 'profile-page/stats';
import * as React from 'react';
import Controller from './controller';
import CoverEditor from './cover-editor';
import Links from './links';

interface Props {
  controller: Controller;
}

@observer
export default class Detail extends React.Component<Props> {
  get user() {
    return this.props.controller.state.user;
  }

  render() {
    return (
      <>
        <Cover
          coverUrl={this.props.controller.displayCoverUrl}
          currentMode={this.props.controller.currentMode}
          editor={<CoverEditor controller={this.props.controller} />}
          user={this.user}
        />

        {this.renderNumbers()}

        <DetailBar user={this.user} />

        <Links user={this.props.controller.state.user} />
      </>
    );
  }

  private renderNumbers() {
    if (this.user.is_bot) return null;

    return (
      <div className='profile-detail'>
        <ProfileTournamentBanner banner={this.user.active_tournament_banner} />
        <Badges badges={this.user.badges} />

        <div className='profile-detail__stats'>
          <div>
            <div className='profile-detail__chart-numbers'>
              <div className='profile-detail__values'>
                <Rank stats={this.user.statistics} type='global' />
                <Rank stats={this.user.statistics} type='country' />
              </div>
              {/* TODO: mode switcher */}
            </div>

            <div className='profile-detail__chart'>
              {this.user.statistics.is_ranked ? (
                <RankChart rankHistory={this.user.rank_history} stats={this.user.statistics} />
              ) : (
                <div className='profile-detail__empty-chart'>{osu.trans('users.show.extra.unranked')}</div>
              )}
            </div>
            <div className='profile-detail__chart-numbers'>
              <div className='profile-detail__values'>
                <MedalsCount userAchievements={this.user.user_achievements} />
                <Pp stats={this.user.statistics} />
                <PlayTime stats={this.user.statistics} />
              </div>
              <div className='profile-detail__values'>
                <RankCount stats={this.user.statistics} />
              </div>
            </div>
          </div>

          <div className='profile-detail__separator' />

          <Stats stats={this.user.statistics} />
        </div>
      </div>
    );
  }
}
