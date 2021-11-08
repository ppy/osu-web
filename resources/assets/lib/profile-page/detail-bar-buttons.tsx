// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import FollowUserMappingButton from 'follow-user-mapping-button';
import { FriendButton } from 'friend-button';
import UserExtendedJson from 'interfaces/user-extended-json';
import { route } from 'laroute';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import ExtraMenu, { showExtraMenu } from 'profile-page/extra-menu';
import * as React from 'react';
import { isBlocked } from 'utils/user-helper';

interface Props {
  user: UserExtendedJson;
}

@observer
export default class DetailBarButtons extends React.Component<Props> {
  render() {
    return (
      <>
        <div className='profile-detail-bar__entry'>
          <FriendButton
            alwaysVisible
            followers={this.props.user.follower_count}
            modifiers='profile-page'
            showFollowerCounter
            userId={this.props.user.id}
          />
        </div>
        {this.renderNonBotButtons()}
      </>
    );
  }

  private renderNonBotButtons() {
    if (this.props.user.is_bot) return null;

    return (
      <>
        <div className='profile-detail-bar__entry'>
          <FollowUserMappingButton
            alwaysVisible
            followers={this.props.user.mapping_follower_count}
            modifiers='profile-page'
            showFollowerCounter
            userId={this.props.user.id}
          />
        </div>

        {/* show button even if not logged in */}
        {(core.currentUser == null || (core.currentUser.id !== this.props.user.id && !isBlocked(this.props.user))) && (
          <div className='profile-detail-bar__entry'>
            <a
              className='user-action-button user-action-button--profile-page'
              href={route('messages.users.show', { user: this.props.user.id })}
              title={osu.trans('users.card.send_message')}
            >
              <i className='fas fa-envelope' />
            </a>
          </div>
        )}

        {showExtraMenu(this.props.user) && (
          <div className='profile-detail-bar__entry'>
            <ExtraMenu user={this.props.user} />
          </div>
        )}
      </>
    );
  }
}
