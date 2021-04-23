// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BlockButton } from 'block-button';
import FlagCountry from 'flag-country';
import FollowUserMappingButton from 'follow-user-mapping-button';
import { FriendButton } from 'friend-button';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import * as _ from 'lodash';
import { PopupMenuPersistent } from 'popup-menu-persistent';
import * as React from 'react';
import { ReportReportable } from 'report-reportable';
import { Spinner } from 'spinner';
import { SupporterIcon } from 'supporter-icon';
import UserCardBrick from 'user-card-brick';
import UserGroupBadges from 'user-group-badges';
import { classWithModifiers } from 'utils/css';

export type ViewMode = 'brick' | 'card' | 'list';
export const viewModes: ViewMode[] = ['card', 'list', 'brick'];

interface Props {
  activated: boolean;
  mode: ViewMode;
  modifiers: string[];
  user?: UserJson;
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

  static userLoading: UserJson = {
    avatar_url: '',
    country_code: '',
    cover: {},
    default_group: '',
    id: 0,
    is_active: false,
    is_bot: false,
    is_deleted: false,
    is_online: false,
    is_supporter: false,
    last_visit: '',
    pm_friends_only: true,
    profile_colour: '',
    username: osu.trans('users.card.loading'),
  };

  state: Readonly<State> = {
    avatarLoaded: false,
    backgroundLoaded: false,
  };

  private url?: string;

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

  private get isUserVisible() {
    return this.isUserLoaded && !this.user.is_deleted;
  }

  private get user() {
    return this.props.user || UserCard.userLoading;
  }

  onAvatarLoad = () => {
    this.setState({ avatarLoaded: true });
  };

  onBackgroundLoad = () => {
    this.setState({ backgroundLoaded: true });
  };

  render() {
    if (this.props.mode === 'brick') {
      if (this.props.user == null) {
        return null;
      }

      return <UserCardBrick {...this.props} user={this.props.user} />;
    }

    const modifiers = this.props.modifiers.slice();
    // Setting the active modifiers from the parent causes unwanted renders unless deep comparison is used.
    modifiers.push(this.props.activated ? 'active' : 'highlightable');
    modifiers.push(this.props.mode);

    this.url = this.isUserVisible ? route('users.show', { user: this.user.id }) : undefined;

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
              <div className='user-card__username-row'>
                {this.renderUsername()}
                <div className='user-card__group-badges'><UserGroupBadges groups={this.user.groups} short wrapper='user-card__group-badge' /></div>
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
    const modifiers = { loaded: this.state.avatarLoaded };
    const hasAvatar = osu.present(this.user.avatar_url) && !this.isUserNotFound;

    return (
      <div className='user-card__avatar-space'>
        <div className={classWithModifiers('user-card__avatar-spinner', modifiers)}>
          {hasAvatar && <Spinner modifiers={modifiers} />}
        </div>
        {this.isUserLoaded && hasAvatar && (
          <img
            className={classWithModifiers('user-card__avatar', modifiers)}
            onError={this.onAvatarLoad} // remove spinner if error
            onLoad={this.onAvatarLoad}
            src={this.user.avatar_url}
          />
        )}
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

    if (this.isUserVisible) {
      backgroundLink = (
        <a
          className='user-card__background-container'
          href={this.url}
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
    if (!this.isUserVisible) {
      return null;
    }

    return (
      <div className='user-card__icons'>
        <a
          className='user-card__icon user-card__icon--flag'
          href={route('rankings', { country: this.user.country_code, mode: 'osu', type: 'performance' })}
        >
          <FlagCountry country={this.user.country} />
        </a>

        {this.props.mode === 'card' && (
          <>
            {this.user.is_supporter && (
              <a className='user-card__icon' href={route('support-the-game')}>
                <SupporterIcon modifiers={['user-card']}/>
              </a>
            )}
            <div className='user-card__icon'>
              <FriendButton modifiers={['user-card']} userId={this.user.id} />
            </div>
            <div className='user-card__icon'>
              <FollowUserMappingButton modifiers={['user-card']} userId={this.user.id} />
            </div>
          </>
        )}
      </div>
    );
  }

  renderListModeIcons() {
    if (this.props.mode !== 'list' || !this.isUserVisible) {
      return null;
    }

    return (
      <div className='user-card__icons'>
        {this.user.is_supporter && (
          <a className='user-card__icon' href={route('support-the-game')}>
            <SupporterIcon level={this.user.support_level} modifiers={['user-list']} />
          </a>
        )}

        <div className='user-card__icon'>
          <FriendButton modifiers={['user-list']} userId={this.user.id} />
        </div>

        <div className='user-card__icon'>
          <FollowUserMappingButton modifiers={['user-list']} userId={this.user.id} />
        </div>
      </div>
    );
  }

  renderMenuButton() {
    if (this.isSelf) {
      return null;
    }

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

        <BlockButton modifiers={['inline']} onClick={dismiss} userId={this.user.id} wrapperClass='simple-menu__item' />
        <ReportReportable
          className='simple-menu__item'
          icon
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
    if (!this.isUserVisible) {
      return null;
    }

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
    if (!this.isUserVisible) {
      return null;
    }

    return (
      <div className='user-card__status-icon-container'>
        <div className={`user-card__status-icon user-card__status-icon--${this.isOnline ? 'online' : 'offline'}`} />
      </div>
    );
  }

  private renderUsername() {
    const displayName = this.user.is_deleted ? osu.trans('users.deleted') : this.user.username;

    return this.url == null ? (
      <div className='user-card__username u-ellipsis-pre-overflow'>{displayName}</div>
    ) : (
      <a className='user-card__username u-ellipsis-pre-overflow' href={this.url}>
        {displayName}
      </a>
    );
  }
}
