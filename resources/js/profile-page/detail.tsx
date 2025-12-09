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
import { trans } from 'utils/lang';
import Controller from './controller';
import DailyChallenge from './daily-challenge';
import Links from './links';
import Matchmaking from './matchmaking';
import ProfileEditButton from './profile-edit-button';

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
          editor={<ProfileEditButton controller={this.props.controller} />}
          isUpdatingCover={this.props.controller.isUpdatingCover}
          user={this.user}
        />

        {this.user.active_tournament_banners.map((banner) => (
          <ProfileTournamentBanner key={banner.id} banner={banner} />
        ))}

        <Badges badges={this.user.badges} />

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
        <div className='profile-detail__stats'>
          <div>
            <div className='profile-detail__chart-numbers profile-detail__chart-numbers--top'>
              <div className='profile-detail__values'>
                <Rank highest={this.user.rank_highest} stats={this.user.statistics} type='global' />
                <Rank stats={this.user.statistics} type='country' />
              </div>
              <div className='profile-detail__values'>
                <Matchmaking allStats={this.user.matchmaking_stats} />
                <DailyChallenge stats={this.user.daily_challenge_user_stats} />
              </div>
            </div>

            <div className='profile-detail__chart'>
              {this.user.statistics.is_ranked ? (
                <RankChart rankHistory={this.user.rank_history} stats={this.user.statistics} />
              ) : (
                <div className='profile-detail__empty-chart'>{trans('users.show.extra.unranked')}</div>
              )}
            </div>
            <div className='profile-detail__chart-numbers'>
              <div className='profile-detail__values profile-detail__values--grid'>
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
