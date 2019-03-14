/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import * as _ from 'lodash';
import * as moment from 'moment';
import * as React from 'react';

interface PropsInterface {
  modifiers: string[];
  user?: User;
}

interface StateInterface {
  avatarLoaded: boolean;
  backgroundLoaded: boolean;
}

export class UserCard extends React.PureComponent<PropsInterface, StateInterface> {
  static defaultProps = {
    modifiers: [],
  };

  static userLoading: User = {
    cover: {},
    default_group: '',
    id: 0,
    is_active: false,
    is_bot: false,
    is_online: false,
    is_supporter: false,
    pm_friends_only: true,
    username: osu.trans('users.card.loading'),
  };

  readonly state: StateInterface = {
    avatarLoaded: false,
    backgroundLoaded: false,
  };

  onAvatarLoad = () => {
    this.setState({ avatarLoaded: true });
  }

  onBackgroundLoad = () => {
    this.setState({ backgroundLoaded: true });
  }

  render() {
    const details = this.isUserLoaded ?
      <div className='usercard__icons'>
        <div className='usercard__icon'>
          <a href={laroute.route('rankings', { mode: 'osu', type: 'performance', country: this.user.country_code })}>
            <FlagCountry country={ this.user.country }/>
          </a>
        </div>

        {
          this.user.is_supporter ?
          <div className='usercard__icon'>
            <a className='usercard__link-wrapper' href={laroute.route('support-the-game')}>
              <SupporterIcon smaller={true} />
            </a>
          </div> : null
        }

        <div className='usercard__icon'>
          <FriendButton userId={this.user.id} />
        </div>

        {
          this.canMessage ?
          <div className='usercard__icon'>
            <a className='user-action-button user-action-button--message'
              href={laroute.route('messages.users.show', { user: this.user.id })}
              title={osu.trans('users.card.send_message')}
            >
              <i className='fas fa-envelope'></i>
            </a>
          </div> : null
        }
      </div> : null;

    let usercardCss = 'usercard';
    for (const modifier of this.props.modifiers) {
      usercardCss += ` usercard--${modifier}`;
    }

    return (
      <div className={usercardCss}>
        { this.renderBackground() }

        <div className='usercard__card'>
          <div className='usercard__card-content'>
            { this.renderAvatar() }

            <div className='usercard__metadata'>
              <div className='usercard__username'>{ this.user.username }</div>
              { details }
            </div>
          </div>
          { this.renderOnlineStatus() }
        </div>
      </div>
    );
  }

  renderAvatar() {
    let avatarSpaceCssClass = 'usercard__avatar-space';
    if (!this.state.avatarLoaded) {
      avatarSpaceCssClass += ' usercard__avatar-space--loading';
    }

    return (
      <div className={avatarSpaceCssClass}>
        <div className='usercard__avatar usercard__avatar--loader'>
          { !this.isUserNotFound ? <div className='la-ball-clip-rotate'></div> : null }
        </div>
        {
          this.isUserLoaded ? <img className='usercard__avatar usercard__avatar--main'
                                   onError={this.onAvatarLoad} // remove spinner if error
                                   onLoad={this.onAvatarLoad}
                                   src={this.user.avatar_url}
                              />
                            : null
        }
      </div>
    );
  }

  renderBackground() {
    let background: React.ReactNode;
    let backgroundLink: React.ReactNode;

    if (this.user.cover && this.user.cover.url) {
      let backgroundCssClass = 'usercard__background';
      if (!this.state.backgroundLoaded) {
        backgroundCssClass += ' usercard__background--loading';
      }

      background =
        <>
          <img className={backgroundCssClass} onLoad={this.onBackgroundLoad} src={this.user.cover.url} />
          <div className='usercard__background-overlay'></div>
        </>;
    } else {
      background = <div className='usercard__background-overlay usercard__background-overlay--guest'></div>;
    }

    if (this.isUserLoaded) {
      backgroundLink =
        <a href={laroute.route('users.show', { user: this.user.id })}
           className='usercard__background-container'>
          {background}
        </a>;
    } else {
      backgroundLink = background;
    }

    return backgroundLink;
  }

  renderOnlineStatus() {
    if (!this.isUserLoaded) { return null; }

    const title = this.user.last_visit && moment(this.user.last_visit).fromNow();
    return (
      <div className={`usercard__status-bar usercard__status-bar--${this.user.is_online ? 'online' : 'offline'}`}>
        <span className='far fa-fw fa-circle usercard__status-icon'></span>
        <span className='usercard__status-message' title={title}>
          {this.user.is_online ? osu.trans('users.status.online') : osu.trans('users.status.offline')}
        </span>
      </div>
    );
  }

  private get canMessage() {
    return currentUser != null
       && _.find(currentUser.blocks, { target_id: this.user.id }) == null;
  }

  private get isUserLoaded() {
    return Number.isFinite(this.user.id) && this.user.id > 0;
  }

  private get isUserNotFound() {
    return this.user.id === -1;
  }

  private get user() {
    return this.props.user || UserCard.userLoading;
  }
}
