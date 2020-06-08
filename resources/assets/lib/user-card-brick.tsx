// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJSON from 'interfaces/user-json';
import { route } from 'laroute';
import * as _ from 'lodash';
import * as React from 'react';
import { ViewMode } from 'user-card';
import UserCardTypeContext from 'user-card-type-context';

interface Props {
  mode: ViewMode;
  modifiers: string[];
  user: UserJSON;
}

interface State {
  backgroundLoaded: boolean;
}

interface UserRelationJson {
  mutual: boolean;
  relation_type: 'friend' | 'block';
  target_id: number;
}

export default class UserCardBrick extends React.PureComponent<Props, State> {
  static readonly contextType = UserCardTypeContext;

  static defaultProps = {
    mode: 'brick',
    modifiers: [],
  };

  readonly eventId = `user-card-brick-${osu.uuid()}`;
  readonly state: State = {
    backgroundLoaded: false,
  };

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
      <div
        className={`js-usercard ${osu.classWithModifiers('user-card-brick', modifiers)}`}
        data-user-id={this.props.user.id}
      >
        {this.renderBackground()}

        <div
          className='user-card-brick__group-bar'
          style={osu.groupColour(this.props.user.groups?.[0])}
          title={this.props.user.groups?.[0]?.name}
        />

        <a className='user-card-brick__username' href={route('users.show', { user: this.props.user.id })}>
          <div className='u-ellipsis-overflow'>{this.props.user.username}</div>
        </a>
      </div>
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
  }

  private onBackgroundLoad = () => {
    this.setState({ backgroundLoaded: true });
  }

  private refresh = () => {
    this.forceUpdate();
  }

  private renderBackground() {
    let background: React.ReactNode | null = null;

    if (this.props.user.cover && this.props.user.cover.url) {
      let backgroundCssClass = 'user-card-brick__background';
      if (this.state.backgroundLoaded) {
        backgroundCssClass += ' user-card-brick__background--loaded';
      }

      background = <img className={backgroundCssClass} onLoad={this.onBackgroundLoad} src={this.props.user.cover.url} />;
    }

    return (
      <a
        href={route('users.show', { user: this.props.user.id })}
        className='user-card-brick__background-container'
      >
        {background}
      </a>
    );
  }
}
