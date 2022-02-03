// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import FollowUserMappingButton from 'components/follow-user-mapping-button';
import FriendButton from 'components/friend-button';
import UserLevel from 'components/user-level';
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
export default class DetailBar extends React.Component<Props> {
  render() {
    return (
      <div className='profile-detail-bar'>
        <FriendButton
          alwaysVisible
          followers={this.props.user.follower_count}
          modifiers='profile-page'
          userId={this.props.user.id}
        />

        {this.renderNonBotButtons()}
      </div>
    );
  }

  private renderNonBotButtons() {
    if (this.props.user.is_bot) return null;

    return (
      <>
        <FollowUserMappingButton
          alwaysVisible
          followers={this.props.user.mapping_follower_count}
          modifiers='profile-page'
          showFollowerCounter
          userId={this.props.user.id}
        />

        {/* show button even if not logged in */}
        {(core.currentUser == null || (core.currentUser.id !== this.props.user.id && !isBlocked(this.props.user))) &&
          <a
            className='user-action-button user-action-button--profile-page'
            href={route('messages.users.show', { user: this.props.user.id })}
            title={osu.trans('users.card.send_message')}
          >
            <i className='fas fa-envelope' />
          </a>
        }

        {showExtraMenu(this.props.user) && <ExtraMenu user={this.props.user} />}

        {this.props.user.statistics != null &&
          <div className='profile-detail-bar__level'>
            <div className='profile-detail-bar__level-bar'>
              <div
                className='bar bar--user-profile'
                title={osu.trans('users.show.stats.level_progress')}
              >
                <div className='bar__fill' style={{ width: `${this.props.user.statistics.level.progress}%` }}/>
                <div className='bar__text'>{`${this.props.user.statistics.level.progress}%`}</div>
              </div>
            </div>

            <UserLevel level={this.props.user.statistics.level.current} />
          </div>
        }
      </>
    );
  }
}
