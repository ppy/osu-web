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

import * as React from 'react';

interface PropsInterface {
  user: User;
  loading?: boolean;
}

export class UserCard extends React.PureComponent<PropsInterface> {
  render(): React.ReactNode {
    const { user } = this.props;
    let background: React.ReactFragment;

    if (user.cover && user.cover.url) {
      background =
        <React.Fragment>
          <img className='usercard__background' src={user.cover.url} />
          <div className='usercard__background-overlay'></div>
        </React.Fragment>;
    } else {
      background = <div className='usercard__background-overlay usercard__background-overlay--guest'></div>;
    }

    return (
      <div className='usercard'>
        <a href={laroute.route('users.show', { user: user.id })} className='usercard__background-container'>
          {background}
        </a>

        <div className='usercard__card'>
          <div className='usercard__card-content'>
            <div className='usercard__avatar-space'>
              <div className='usercard__avatar usercard__avatar--loader js-usercard--avatar-loader'></div>
              <img className='usercard__avatar usercard__avatar--main' src={user.avatar_url} />
            </div>
            <div className='usercard__metadata'>
              <div className='usercard__username'>{this.props.loading ? osu.trans('users.card.loading') : user.username}</div>
              <div className='usercard__icons'>
                <div className='usercard__icon'>
                  <a href={laroute.route('rankings', { mode: 'osu', type: 'performance', country: user.country_code })}>
                    <FlagCountry country={ user.country }/>
                  </a>
                </div>

                { user.is_supporter ?
                  <div className='usercard__icon'>
                    <a className='usercard__link-wrapper' href={laroute.route('support-the-game')}>
                      <SupporterIcon smaller={true} />
                    </a>
                  </div>
                  : null
                }
                <div className='usercard__icon'>
                  <FriendButton userId={user.id} />
                </div>

                { currentUser != null ? // TODO: need to get blocks
                  <div className='usercard__icon'>
                    <a className='user-action-button user-action-button--message'
                      href={laroute.route('messages.users.show', { user: user.id })}
                      title={osu.trans('users.card.send_message')}
                    >
                      <i className='fas fa-envelope'></i>
                    </a>
                  </div>
                  : null
                }
              </div>
            </div>
          </div>
          <div className={`usercard__status-bar usercard__status-bar--${user.is_online ? 'online' : 'offline'}`}>
            <span className='far fa-fw fa-circle usercard__status-icon'></span>
            <span className='usercard__status-message' title='last visit'>
              {user.is_online ? osu.trans('users.status.online') : osu.trans('users.status.offline')}
            </span>
          </div>
        </div>
      </div>
    );
  }
}
