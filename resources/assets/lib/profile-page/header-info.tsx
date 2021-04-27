// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import FlagCountry from 'flag-country';
import GameMode from 'interfaces/game-mode';;
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

const bn = 'profile-info';

export default class HeaderInfo extends React.PureComponent<Props> {
  render() {
    const avatar = <UserAvatar modifiers={['full']} user={this.props.user} />;
    return (
      <div className={bn}>
        <div className={`${bn}_bg`} style={{ backgroundImage: osu.urlPresence(this.props.coverUrl) }} />
        {this.props.user.id === currentUser.id ? (
          <a className={`${bn}__avatar`} href={`${route('account.edit')}$avatar`} title={osu.trans('users.show.change_avatar')}>{avatar}</a>
        ) : (
          <div className={`${bn}__avatar`}>{avatar}</div>
        )}
        <div className={`${bn}__details`}>
          <h1 className={`${bn}__name`}>
            <span className='u-ellipsis-pre-overflow'>{this.props.user.username}</span>
            <div className={`${bn}__previous-usernames`}>{this.previousUsernames()}</div>
          </h1>
          {this.renderTitle()}
          <div className={`${bn}__icon-group`}>
            <div className={`${bn}__icons`}>
              {this.props.user.is_supporter && (
                <span className={`${bn}__icon ${bn}__icon--supporter`} title={osu.trans('users.show.is_supporter')}>
                  {
                    _(this.props.user.support_level).times((i) => <span key={i} className='fas fa-heart'/>)
                  }
                </span>
              )}
              <UserGroupBadges groups={this.props.user.groups} modifiers={['profile-page']} wrapper={`${bn}__icon`} />
            </div>
            <div className={`${bn}__icons ${bn}__icons--flag`}>
              {this.props.user.country?.code != null && (
                <a
                  className={`${bn}__flag ${bn}__flag--country`}
                  href={route('rankings', { country: this.props.user.country.code, mode: this.props.currentMode, type: 'performance' })}
                >
                  <span className={`${bn}__flag-flag`}>
                    <FlagCountry country={this.props.user.country} />
                  </span>
                  <span className={`${bn}__flag-text`}>{this.props.user.country.name}</span>
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
      className: `${bn}__title`,
      href: this.props.user.title_url,
      style: { color: this.props.user.profile_colour },
    };

    return this.props.user.title_url != null ? (
      <a {...props}>{this.props.user.title}</a>
    ) : (
      <span {...props}>{this.props.user.title}</span>
    );
  }


  private doNothing = () => {
    //
  };

  private previousUsernames() {
    if (this.props.user.previous_usernames.length === 0) return null;

    const previousUsernames = this.props.user.previous_usernames.join(', ');

    return (
      <div className='profile-previous-usernames'>
        <a
          className='profile-previous-usernames__icon profile-previous-usernames__icon--with-title'
          onClick={this.doNothing}
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
