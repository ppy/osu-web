// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-json';
import UserRelationJson from 'interfaces/user-relation-json';
import { route } from 'laroute';
import * as _ from 'lodash';
import osu from 'osu-common';
import * as React from 'react';
import { ViewMode } from 'user-card';
import UserCardTypeContext from 'user-card-type-context';
import { classWithModifiers } from 'utils/css';
import { nextVal } from 'utils/seq';

interface Props {
  mode: ViewMode;
  modifiers: string[];
  user: UserJson;
}

export default class UserCardBrick extends React.PureComponent<Props> {
  static readonly contextType = UserCardTypeContext;

  static defaultProps = {
    mode: 'brick',
    modifiers: [],
  };

  declare context: React.ContextType<typeof UserCardTypeContext>;

  private readonly eventId = `user-card-brick-${nextVal()}`;

  componentDidMount() {
    $.subscribe(`friendButton:refresh.${this.eventId}`, this.refresh);
  }

  componentWillUnmount() {
    $.unsubscribe(`.${this.eventId}`);
  }

  render() {
    const modifiers = this.props.modifiers.concat(this.props.mode);
    this.addFriendModifier(modifiers);

    return (
      <a
        className={`js-usercard ${classWithModifiers('user-card-brick', modifiers)}`}
        data-user-id={this.props.user.id}
        href={route('users.show', { user: this.props.user.id })}
      >
        <div
          className='user-card-brick__group-bar'
          style={osu.groupColour(this.props.user.groups?.[0])}
          title={this.props.user.groups?.[0]?.name}
        />

        <div className='user-card-brick__username u-ellipsis-overflow'>
          {this.props.user.username}
        </div>
      </a>
    );
  }

  private addFriendModifier = (modifiers: string[]) => {
    let isFriend = false;
    let isMutual = false;

    if (currentUser.friends != null) {
      const friendState = currentUser.friends.find((friend: UserRelationJson) => friend.target_id === this.props.user.id);

      if (friendState != null) {
        isFriend = true;
        isMutual = friendState.mutual;
      }
    }

    if (isMutual) {
      modifiers.push('mutual');
    } else if (isFriend && !this.context.isFriendsPage) {
      modifiers.push('friend');
    }
  };

  private refresh = () => {
    this.forceUpdate();
  };
}
