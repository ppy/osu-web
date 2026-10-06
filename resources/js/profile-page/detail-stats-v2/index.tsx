// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Img2x from 'components/img2x';
import TimeWithTooltip from 'components/time-with-tooltip';
import { observer } from 'mobx-react';
import BadgePinButton from 'profile-page/badge-pin-button';
import Controller from 'profile-page/controller';
import DailyChallenge from 'profile-page/daily-challenge';
import SeasonStats from 'profile-page/season-stats';
import Stats from 'profile-page/stats';
import * as React from 'react';
import Matchmaking from './matchmaking';
import Solo from './solo';

interface Props {
  controller: Controller;
}

@observer
export default class DetailStatsV2 extends React.Component<Props> {
  render() {
    return (
      <div className='profile-detail-stats-v2'>
        <Solo controller={this.props.controller} />
        <Matchmaking controller={this.props.controller} />

        <div className='profile-detail-stats-card profile-detail-stats-card--extra'>
          {this.renderPinnedBadge()}
          <DailyChallenge stats={this.props.controller.state.user.daily_challenge_user_stats} v2 />
          {this.props.controller.state.user.current_season_stats != null &&
            <SeasonStats stats={this.props.controller.state.user.current_season_stats} v2 />
          }
          <Stats stats={this.props.controller.state.user.statistics} v2 />
        </div>
      </div>
    );
  }

  private renderPinnedBadge() {
    const image = this.props.controller.state.user.profile_pinned_badge;
    if (image == null) return;

    const badge = this.props.controller.state.user.badges.find((b) => b.image === image);
    if (badge == null) return;

    return (
      <div className='profile-detail-stats-big'>
        <div className='profile-detail-stats-big__icon'>
          <div className='svg-icon svg-icon--trophy' />
        </div>
        <div className='profile-detail-stats-big__title-container'>
          <div className='profile-detail-stats-big__label u-ellipsis-overflow'>
            {badge.name ?? badge.description}
          </div>
          <div className='profile-detail-stats-big__fancy-text1'>
            <TimeWithTooltip dateTime={badge.awarded_at} />
          </div>
        </div>
        <Img2x
          className='profile-detail-stats-big__badge'
          src={badge.image_url}
        />
        {this.props.controller.withEdit && (
          <div className='profile-detail-stats-big__pin'>
            <BadgePinButton badge={badge} controller={this.props.controller} />
          </div>
        )}
      </div>
    );
  }
}
