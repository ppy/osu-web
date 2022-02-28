// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import FlagCountry from 'components/flag-country';
import UserAvatar from 'components/user-avatar';
import UserGroupBadges from 'components/user-group-badges';
import GameMode from 'interfaces/game-mode';
import UserExtendedJson from 'interfaces/user-extended-json';
import { route } from 'laroute';
import { times } from 'lodash';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  coverUrl: string | null;
  currentMode: GameMode | null;
  editor?: JSX.Element;
  user: UserExtendedJson;
}

function doNothing() {
  //
}

@observer
export default class Cover extends React.Component<Props> {
  @computed
  get showCover() {
    return core.userPreferences.get('profile_cover_expanded');
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    return (
      <div className={classWithModifiers('profile-info', { cover: this.showCover })}>
        {this.showCover &&
          <div className='profile-info__bg' style={{ backgroundImage: osu.urlPresence(this.props.coverUrl) }}>
            {this.props.editor}
          </div>
        }
        <div className='profile-info__details'>
          {this.props.user.id === core.currentUser?.id ? (
            <a
              className='profile-info__avatar'
              href={`${route('account.edit')}#avatar`}
              title={osu.trans('users.show.change_avatar')}
            >
              {this.renderAvatar()}
            </a>
          ) : (
            <div className='profile-info__avatar'>{this.renderAvatar()}</div>
          )}

          <div className='profile-info__info'>
            <h1 className='profile-info__name'>
              <span className='u-ellipsis-pre-overflow'>{this.props.user.username}</span>

              <div className='profile-info__previous-usernames'>{this.renderPreviousUsernames()}</div>

              <div className='profile-info__icons profile-info__icons--name-inline'>
                {this.renderIcons()}
              </div>
            </h1>

            {this.renderTitle()}

            <div className='profile-info__flags'>
              {this.props.user.country?.code != null &&
                <a
                  className='profile-info__flag'
                  href={route('rankings', { country: this.props.user.country.code, mode: this.props.currentMode, type: 'performance' })}
                >
                  <span className='profile-info__flag-flag'>
                    <FlagCountry country={this.props.user.country} />
                  </span>
                  <span className='profile-info__flag-text'>{this.props.user.country.name}</span>
                </a>
              }
              <div className='profile-info__icons profile-info__icons--flag-inline'>
                {this.renderIcons()}
              </div>
            </div>
          </div>

          <div className='profile-info__cover-toggle'>
            <button
              className='btn-circle btn-circle--page-toggle'
              onClick={this.onCoverExpandedToggle}
              title={osu.trans(`users.show.cover.to_${this.showCover ? '0' : '1'}`)}
              type='button'
            >
              <span className={this.showCover ? 'fas fa-chevron-up' : 'fas fa-chevron-down'} />
            </button>
          </div>
        </div>
      </div>
    );
  }

  private readonly onCoverExpandedToggle = () => {
    void core.userPreferences.set('profile_cover_expanded', !this.showCover);
  };

  private renderAvatar() {
    return <UserAvatar modifiers='full' user={this.props.user} />;
  }

  private renderIcons() {
    return (
      <>
        {this.props.user.is_supporter &&
          <span className='profile-info__icon profile-info__icon--supporter' title={osu.trans('users.show.is_supporter')}>
            {times(this.props.user.support_level ?? 0, (i) => <span key={i} className='fas fa-heart'/>)}
          </span>
        }
        <UserGroupBadges groups={this.props.user.groups} modifiers='profile-page' wrapper='profile-info__icon' />
      </>
    );
  }

  private renderPreviousUsernames() {
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

  private renderTitle() {
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
}
