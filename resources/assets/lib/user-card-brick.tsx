// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { FriendButton } from 'friend-button';
import { route } from 'laroute';
import * as _ from 'lodash';
import * as React from 'react';
import { ViewMode } from 'user-card';
import UserCardTypeContext from 'user-card-type-context';

interface Props {
  isFriendsPage: boolean;
  mode: ViewMode;
  modifiers: string[];
  user: User;
}

interface State {
  backgroundLoaded: boolean;
}

export default class UserCardBrick extends React.PureComponent<Props, State> {
  static readonly contextType = UserCardTypeContext;

  static defaultProps = {
    isFriendsPage: false,
    mode: 'brick',
    modifiers: [],
  };

  readonly state: State = {
    backgroundLoaded: false,
  };

  render() {
    const modifiers = this.props.modifiers.slice();
    modifiers.push(this.props.mode);

    const friendButtonShowIf = this.context.isFriendsPage ? 'mutual' : 'friend';

    return (
      <div
        className={`js-usercard ${osu.classWithModifiers('user-card-brick', modifiers)}`}
        data-user-id={this.props.user.id}
      >
        {this.renderBackground()}

        <div
          className='user-card-brick__group-bar'
          style={osu.groupColour(this.props.user.group_badge)}
          title={this.props.user.group_badge?.name}
        />

        <a className='user-card-brick__username' href={route('users.show', { user: this.props.user.id })}>
          <div className='u-ellipsis-overflow'>{this.props.user.username}</div>
        </a>

        <div className='user-card-brick__icon'>
          <FriendButton userId={this.props.user.id} modifiers={['dynamic']} showIf={friendButtonShowIf} />
        </div>
      </div>
    );
  }

  private onBackgroundLoad = () => {
    this.setState({ backgroundLoaded: true });
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
