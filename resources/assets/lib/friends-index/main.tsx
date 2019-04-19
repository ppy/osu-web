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

interface State {
  filter: string;
}

export class Main extends React.PureComponent<Props> {
  static defaultProps = {
    user: currentUser,
  };

  readonly state = {
    filter: this.filterFromUrl,
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

              {/* header tabs */}
              <div className='page-mode-v2 page-mode-v2--users'>
                <span className='page-mode-v2__link page-mode-v2__link--active'>Friends</span>
              </div>
            </div>
          </div>
        </div>

        <div className='osu-page osu-page--users'>
          {this.renderSelections()}
          <UserList users={this.filteredUsers} />
        </div>
      </div>
    );
  }

  renderSelections() {
    const groups = [
      { name: 'all', count: this.props.friends.length },
      { name: 'online', count: this.props.friends.filter((x) => x.is_online).length },
    ];

    return (
      <div className='update-streams-v2'>
        <div className='update-streams-v2__container'>
          {
            groups.map((group) => {
              return this.renderOption(group.name, group.count);
            })
          }
        </div>
      </div>
    );
  }

  renderOption(title: string, text: string | number) {
    return (
      <a
        className='update-streams-v2__item'
        href={osu.updateQueryString(null, { filter: title })}
        key={title}
        onClick={this.optionSelected(title)}
      >
        <div className='update-streams-v2__bar u-changelog-stream--bg' />
        <p className='update-streams-v2__row update-streams-v2__row--name'>{title}</p>
        <p className='update-streams-v2__row update-streams-v2__row--version'>{text}</p>
      </a>
    );
  }

  optionSelected = (key: string) => (event: React.SyntheticEvent) => {
    event.preventDefault();
    const url = osu.updateQueryString(null, { filter: key });
    // FIXME: stop reloading the page
    Turbolinks.controller.pushHistoryWithLocationAndRestorationIdentifier(url, Turbolinks.uuid());
    this.setState({ filter: key });
  }

  private get filterFromUrl() {
    const url = new URL(location.href);
    return url.searchParams.get('filter') || 'all';
  }

  private get filteredUsers() {
    switch (this.state.filter) {
      case 'online':
        return this.props.friends.filter((x) => x.is_online);
    }

    return this.props.friends;
  }
}
