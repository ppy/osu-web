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

import { BlockButton } from 'block-button';
import { FlagCountry } from 'flag-country';
import { FriendButton } from 'friend-button';
import { route } from 'laroute';
import * as _ from 'lodash';
import { PopupMenuPersistent } from 'popup-menu-persistent';
import * as React from 'react';
import { ReportReportable } from 'report-reportable';
import { Spinner } from 'spinner';
import { SupporterIcon } from 'supporter-icon';

export type ViewMode = 'card' | 'list';

interface Props {
  activated: boolean;
  mode: ViewMode;
  modifiers: string[];
  user?: User;
}

interface State {
  avatarLoaded: boolean;
  backgroundLoaded: boolean;
}

export class UserCard extends React.PureComponent<Props, State> {
  static defaultProps = {
    activated: false,
    mode: 'card',
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

  readonly state: State = {
    avatarLoaded: false,
    backgroundLoaded: false,
  };

  private get canMessage() {
    return !this.isSelf
      && _.find(currentUser.blocks, { target_id: this.user.id }) == null;
  }

  private get isOnline() {
    return this.user.is_online;
  }

  private get isSelf() {
    return currentUser.id === this.user.id;
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

  onAvatarLoad = () => {
    this.setState({ avatarLoaded: true });
  }

  onBackgroundLoad = () => {
    this.setState({ backgroundLoaded: true });
  }

  render() {
    const modifiers = this.props.modifiers.slice();
    // Setting the active modifiers from the parent causes unwanted renders unless deep comparison is used.
    modifiers.push(this.props.activated ? 'active' : 'highlightable');
    modifiers.push(this.props.mode);

    return (
      <div className={osu.classWithModifiers('user-card', modifiers)}>
        {this.renderBackground()}

        <div className='user-card__card'>
          <div className='user-card__content user-card__content--details'>
            <div className='user-card__user'>
              {this.renderAvatar()}
            </div>
            <div className='user-card__details'>
              {this.renderIcons()}
              <div className='user-card__username'>
                <div className='u-ellipsis-overflow'>{this.user.username}</div>
              </div>
              {this.renderListModeIcons()}
            </div>
          </div>
          {this.renderStatusBar()}
        </div>
      </div>
    );
  }

  renderAvatar() {
    const modifiers = this.state.avatarLoaded ? ['loaded'] : [];

    return (
      <div className='user-card__avatar-space'>
        <div className={osu.classWithModifiers('user-card__avatar-spinner', modifiers)}>
          {!this.isUserNotFound ? <Spinner modifiers={modifiers} /> : null}
        </div>
        {
          this.isUserLoaded ? (
            <img
              className={osu.classWithModifiers('user-card__avatar', modifiers)}
              onError={this.onAvatarLoad} // remove spinner if error
              onLoad={this.onAvatarLoad}
              src={this.user.avatar_url}
            />
          ) : null
        }
      </div>
    );
  }

  renderBackground() {
    let background: React.ReactNode;
    let backgroundLink: React.ReactNode;

    const overlayCssClass = osu.classWithModifiers(
      'user-card__background-overlay',
      this.isOnline ? ['online'] : [],
    );

    if (this.user.cover && this.user.cover.url) {
      let backgroundCssClass = 'user-card__background';
      if (!this.state.backgroundLoaded) {
        backgroundCssClass += ' user-card__background--loading';
      }

      background = (
        <>
          <img className={backgroundCssClass} onLoad={this.onBackgroundLoad} src={this.user.cover.url} />
          <div className={overlayCssClass} />
        </>
      );
    } else {
      background = <div className={overlayCssClass} />;
    }

    if (this.isUserLoaded) {
      backgroundLink = (
        <a
          href={route('users.show', { user: this.user.id })}
          className='user-card__background-container'
        >
          {background}
        </a>
      );
    } else {
      backgroundLink = background;
    }

    return backgroundLink;
  }

  renderIcons() {
    if (!this.isUserLoaded) { return null; }

    return (
      <div className='user-card__icons'>
        <a
          className='user-card__icon user-card__icon--flag'
          href={route('rankings', { mode: 'osu', type: 'performance', country: this.user.country_code })}
        >
          <FlagCountry country={this.user.country} modifiers={['full']} />
        </a>

        {
          this.props.mode === 'card' && this.user.is_supporter ?
          <a className='user-card__icon' href={route('support-the-game')}>
            <SupporterIcon modifiers={['user-card']}/>
          </a> : null
        }

        {
          this.props.mode === 'card' ?
          <div className='user-card__icon'>
            <FriendButton userId={this.user.id} modifiers={['user-card']} />
          </div> : null
        }
      </div>
    );
  }

  renderListModeIcons() {
    if (this.props.mode !== 'list' || !this.isUserLoaded || !this.user.is_supporter) { return null; }

    return (
      <div className='user-card__icons'>
        <a className='user-card__icon' href={route('support-the-game')}>
          <SupporterIcon level={this.user.support_level} />
        </a>
      </div>
    );
  }

  renderMenuButton() {
    if (this.isSelf) { return null; }

    const items = (dismiss: () => void) => (
      <>
        {
          this.canMessage ? (
            <a
              className='simple-menu__item js-login-required--click'
              href={route('messages.users.show', { user: this.user.id })}
              onClick={dismiss}
            >
              <span className='fas fa-envelope' />
              {` ${osu.trans('users.card.send_message')}`}
            </a>
          ) : null
        }

        <BlockButton onClick={dismiss} modifiers={['inline']} userId={this.user.id} wrapperClass='simple-menu__item' />
        <ReportReportable
          className='simple-menu__item'
          icon={true}
          onFormClose={dismiss}
          reportableId={this.user.id.toString()}
          reportableType='user'
          user={this.user}
        />
      </>
    );

    return (
      <div className='user-card__icon user-card__icon--menu'>
        <PopupMenuPersistent>{items}</PopupMenuPersistent>
      </div>
    );
  }

  renderStatusBar() {
    if (!this.isUserLoaded) { return null; }

    const lastSeen = (!this.isOnline && this.user.last_visit != null) ? osu.trans('users.show.lastvisit', { date: osu.timeago(this.user.last_visit) }) : '';
    const status = this.isOnline ? osu.trans('users.status.online') : osu.trans('users.status.offline');

    return (
      <div className='user-card__content user-card__content--status'>
        <div className='user-card__status'>
          {this.renderStatusIcon()}
          <div className='user-card__status-messages'>
            <span
              className='user-card__status-message user-card__status-message--sub u-ellipsis-overflow'
              dangerouslySetInnerHTML={{ __html: lastSeen }}
            />
            <span className='user-card__status-message u-ellipsis-overflow'>
              {status}
            </span>
          </div>
        </div>
        <div className='user-card__icons user-card__icons--menu'>
          {this.renderMenuButton()}
        </div>
      </div>
    );
  }

  renderStatusIcon() {
    if (!this.isUserLoaded) { return null; }

    return (
      <div className='user-card__status-icon-container'>
        <div className={`user-card__status-icon user-card__status-icon--${this.isOnline ? 'online' : 'offline'}`} />
      </div>
    );
  }
}
