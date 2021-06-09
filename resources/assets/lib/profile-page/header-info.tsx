// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import FlagCountry from 'flag-country';
import GameMode from 'interfaces/game-mode';
import UserJsonExtended from 'interfaces/user-json-extended';
import { route } from 'laroute';
import * as _ from 'lodash';
import * as React from 'react';
import UserAvatar from 'user-avatar';
import UserGroupBadges from 'user-group-badges';

interface Props {
  coverUrl: string | null;
  currentMode: GameMode | null;
  user: UserJsonExtended;
}

function doNothing() {
  //
}

export default class HeaderInfo extends React.PureComponent<Props> {
  render() {
    const avatar = <UserAvatar modifiers={['full']} user={this.props.user} />;
    return (
      <div className='profile-info'>
        <div className='profile-info__bg' style={{ backgroundImage: osu.urlPresence(this.props.coverUrl) }} />
        {this.props.user.id === currentUser.id ? (
          <a className='profile-info__avatar' href={`${route('account.edit')}#avatar`} title={osu.trans('users.show.change_avatar')}>{avatar}</a>
        ) : (
          <div className='profile-info__avatar'>{avatar}</div>
        )}
        <div className='profile-info__details'>
          <h1 className='profile-info__name'>
            <span className='u-ellipsis-pre-overflow'>{this.props.user.username}</span>
            <div className='profile-info__previous-usernames'>{this.previousUsernames()}</div>
          </h1>
          {this.renderTitle()}
          <div className='profile-info__icon-group'>
            <div className='profile-info__icons'>
              {this.props.user.is_supporter && (
                <span className='profile-info__icon profile-info__icon--supporter' title={osu.trans('users.show.is_supporter')}>
                  {
                    _(this.props.user.support_level).times((i) => <span key={i} className='fas fa-heart'/>)
                  }
                </span>
              )}
              <UserGroupBadges groups={this.props.user.groups} modifiers={['profile-page']} wrapper='profile-info__icon' />
            </div>
            <div className='profile-info__icons profile-info__icons--flag'>
              {this.props.user.country?.code != null && (
                <a
                  className='profile-info__flag profile-info__flag--country'
                  href={route('rankings', { country: this.props.user.country.code, mode: this.props.currentMode, type: 'performance' })}
                >
                  <span className='profile-info__flag-flag'>
                    <FlagCountry country={this.props.user.country} />
                  </span>
                  <span className='profile-info__flag-text'>{this.props.user.country.name}</span>
                </a>
              )}
            </div>
          </div>
        </div>
        <div
          className='profile-info__bar hidden-xs'
          style={{ backgroundColor: this.props.user.profile_colour ?? '' }}
        />
      </div>
    );
  }

  renderTitle() {
    if (this.props.user.title == null) return null;

    const props = {
      children: this.props.user.title,
      className: 'profile-info__title',
      style: { color: this.props.user.profile_colour ?? undefined },
    };

    return this.props.user.title_url != null ? (
      <a href={this.props.user.title_url} {...props} />
    ) : (
      <span {...props} />
    );
  }

  private previousUsernames() {
    if (this.props.user.previous_usernames == null || this.props.user.previous_usernames.length === 0) return null;

    const previousUsernames = this.props.user.previous_usernames.join(', ');

    return (
      <div className='profile-previous-usernames'>
        {/* FIXME: doesn't quite work reliably. Link so title is shown in mobile (onClick is required) */}
        <a
          className='profile-previous-usernames__icon profile-previous-usernames__icon--with-title'
          onClick={doNothing}
          title={`${osu.trans('users.show.previous_usernames')}: ${previousUsernames}`}
        >
          <span className='fas fa-address-card' />
        </a>
        <div className='profile-previous-usernames__icon profile-previous-usernames__icon--plain'>
          <span className='fas fa-address-card' />
        </div>
        <div className='profile-previous-usernames__content'>
          <div className='profile-previous-usernames__title'>{osu.trans('users.show.previous_usernames')}</div>
          <div className='profile-previous-usernames__names'>{previousUsernames}</div>
        </div>
      </div>
    );
  }
}
