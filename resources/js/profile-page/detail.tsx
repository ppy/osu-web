// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ProfileTournamentBanner from 'components/profile-tournament-banner';
import StringWithComponent from 'components/string-with-component';
import { observer } from 'mobx-react';
import * as React from 'react';
import { trans } from 'utils/lang';
import Badges from './badges';
import Controller from './controller';
import Cover from './cover';
import DetailBar from './detail-bar';
import DetailStats from './detail-stats';
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
            <DetailStats user={user} />
          </div>
        )}

        {this.renderScoresNotice()}

        <DetailBar user={user} />

        <Links user={user} />
      </>
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
