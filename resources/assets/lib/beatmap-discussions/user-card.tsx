// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserAvatar from 'components/user-avatar';
import UserGroupBadge from 'components/user-group-badge';
import UserGroupJson from 'interfaces/user-group-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import * as React from 'react';
import { groupColour } from 'utils/css';
import { trans } from 'utils/lang';

const bn = 'beatmap-discussion-user-card';

interface Props {
  group?: UserGroupJson | null;
  hideStripe: boolean;
  user: UserJson;
}

export class UserCard extends React.PureComponent<Props> {
  static readonly defaultProps = {
    hideStripe: false,
  };

  render() {
    return (
      <div className={bn} style={groupColour(this.props.group)}>
        <div className={`${bn}__avatar`}>
          {this.props.user.is_deleted ? (
            <span className={`${bn}__user-link`}>
              <UserAvatar modifiers='full-rounded' user={this.props.user} />
            </span>
          ) : (
            <a
              className={`${bn}__user-link`}
              href={route('users.show', { user: this.props.user.id })}
            >
              <UserAvatar modifiers='full-rounded' user={this.props.user} />
            </a>
          )}
        </div>

        <div className={`${bn}__user`}>
          <div className={`${bn}__user-row`}>
            {this.props.user.is_deleted ? (
              <span className={`${bn}__user-link`}>
                {this.renderUsername()}
              </span>

            ) : (
              <a
                className={`${bn}__user-link`}
                href={route('users.show', { user: this.props.user.id })}
              >
                {this.renderUsername()}
              </a>
            )}
            {!this.props.user.is_bot && !this.props.user.is_deleted && (
              <a
                className={`${bn}__user-modding-history-link`}
                href={route('users.modding.index', { user: this.props.user.id })}
                title={trans('beatmap_discussion_posts.item.modding_history_link')}
              >
                <i className='fas fa-align-left' />
              </a>
            )}
          </div>

          <div className={`${bn}__user-badge`}>
            <UserGroupBadge group={this.props.group} />
          </div>
        </div>

        {!this.props.hideStripe && <div className={`${bn}__user-stripe`} />}
      </div>
    );
  }

  private renderUsername() {
    return (
      <span className='u-ellipsis-overflow'>
        {this.props.user.username}
      </span>
    );
  }
}
