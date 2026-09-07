// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ProfileTournamentBanner from 'components/profile-tournament-banner';
import StringWithComponent from 'components/string-with-component';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import Badges from './badges';
import Controller from './controller';
import Cover from './cover';
import DetailBar from './detail-bar';
import DetailStats from './detail-stats';
import DetailStatsV2 from './detail-stats-v2';
import Links from './links';
import ProfileEditButton from './profile-edit-button';

interface Props {
  controller: Controller;
}

@observer
export default class Detail extends React.Component<Props> {
  render() {
    const user = this.props.controller.state.user;

    return (
      <>
        <Cover
          coverUrl={this.props.controller.displayCoverUrl}
          currentMode={this.props.controller.currentMode}
          editor={<ProfileEditButton controller={this.props.controller} />}
          isUpdatingCover={this.props.controller.isUpdatingCover}
          user={user}
        />

        {user.active_tournament_banners.map((banner) => (
          <ProfileTournamentBanner key={banner.id} banner={banner} />
        ))}

        <Badges badges={user.badges} />

        {!user.is_bot && (
          <div className='profile-detail'>
            {core.userPreferences.get('profile_detail_v2')
              ? <DetailStatsV2 controller={this.props.controller} />
              : <DetailStats user={user} />
            }
            {this.renderDetailToggle()}

            {this.renderScoresNotice()}
          </div>
        )}

        <DetailBar user={user} />

        <Links user={user} />
      </>
    );
  }

  private handleDetailToggle(this: void) {
    core.userPreferences.toggle('profile_detail_v2');
  }

  private renderDetailToggle() {
    const activated = core.userPreferences.get('profile_detail_v2');

    const title = activated
      ? trans('users.show.detail_switch.to_v1')
      : trans('users.show.detail_switch.to_v2');

    return (
      <div className='profile-detail__type-toggle'>
        <button
          className={classWithModifiers('btn-circle', 'page-toggle', { activated })}
          onClick={this.handleDetailToggle}
          title={title}
          type='button'
        >
          <span className='fas fa-users' />
        </button>
      </div>
    );
  }

  private renderScoresNotice() {
    if (this.props.controller.scoreProcessingNoticeUrl == null) return null;

    return (
      <div className='wiki-notice wiki-notice--profile-page-extra'>
        <span className='fas fa-exclamation-circle' />
        {' '}
        <div className='wiki-notice__markdown-inline-content'>
          <StringWithComponent
            mappings={{
              link: (
                <a href={this.props.controller.scoreProcessingNoticeUrl}>
                  {trans('users.show.score_processing.title_link')}
                </a>
              ),
            }}
            pattern={trans('users.show.score_processing.title')}
          />
          {' '}
          {trans('users.show.score_processing.message')}
        </div>
      </div>
    );
  }
}
