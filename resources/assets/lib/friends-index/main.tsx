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
import { Main as UserList } from 'user-list/main';

interface Props {
  user: User;
  friends: User[];
}

export class Main extends React.PureComponent<Props> {
  static defaultProps = {
    user: currentUser,
  };

  render() {
    return (
      <div className='osu-layout osu-layout--full'>
        {/* header */}
        <div className='header-v3 header-v3--users'>
          <div
            className='header-v3__bg'
            style={{ backgroundImage: osu.urlPresence(this.props.user.cover.custom_url) }}
          />
          <div className='header-v3__overlay'></div>
          <div className='osu-page osu-page--header-v3'>
            {/* header title */}
            <div className='osu-page-header-v3 osu-page-header-v3--users'>
              <div className='osu-page-header-v3__title js-nav2--hidden-on-menu-access'>
                <div className='osu-page-header-v3__title-icon'>
                  <div className='osu-page-header-v3__icon'></div>
                </div>
                <h1 className='osu-page-header-v3__title-text'>Home <span className='osu-page-header-v3__title-highlight'>Friends</span>
                </h1>
              </div>

              {this.renderHeaderTabs()}
            </div>
          </div>
        </div>

        <div className='osu-page osu-page--users'>
          <UserList users={this.props.friends} />
        </div>
      </div>
    );
  }

  renderHeaderTabs() {
    const list = [
      { title: 'Dashboard', key: 'home' },
      { title: 'News', key: 'news.index' },
      { title: 'Friends', key: 'friends.index', active: true },
      { title: 'Forum Subs', key: 'forum.topic-watches.index' },
      { title: 'Modding Watchlist', key: 'beatmapsets.watches.index' },
      { title: 'Settings', key: 'account.edit' },
    ];

    return (
      <div className='page-mode-v2 page-mode-v2--users'>
        {list.map((item) => {
          return (
            <li className='page-mode-v2__item' key={item.title}>
              <a
                className={`page-mode-v2__link ${item.active ? 'page-mode-v2__link--active' : ''}`}
                href={laroute.route(item.key)}
              >
                {item.title}
              </a>
            </li>
          );
        })}
      </div>
    );
  }
}
