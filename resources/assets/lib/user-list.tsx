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

import * as moment from 'moment';
import * as React from 'react';
import { Sort } from 'sort';
import { UserCards } from 'user-cards';

enum SortMode {
  LastVisit = 'last_visit',
  Username = 'username',
}

interface Props {
  title?: string;
  users: User[];
}

interface State {
  filter: string;
  sortMode: SortMode;
}

export class UserList extends React.PureComponent<Props> {
  readonly state: State = {
    filter: this.filterFromUrl,
    sortMode: this.sortFromUrl,
  };

  onSortSelected = (event: React.SyntheticEvent) => {
    const value = (event.currentTarget as HTMLElement).dataset.value;
    const url = osu.updateQueryString(null, { user_sort: value });

    Turbolinks.controller.pushHistoryWithLocationAndRestorationIdentifier(url, Turbolinks.uuid());
    this.setState({ sortMode: value });
  }

  optionSelected = (event: React.SyntheticEvent) => {
    event.preventDefault();
    const key = (event.currentTarget as HTMLElement).dataset.key;
    const url = osu.updateQueryString(null, { filter: key });

    Turbolinks.controller.pushHistoryWithLocationAndRestorationIdentifier(url, Turbolinks.uuid());
    this.setState({ filter: key });
  }

  render(): React.ReactNode {
    return (
      <>
        {this.renderSelections()}
        <div className='user-list'>
          <div className='user-list__toolbar'>
            {this.renderSorter()}
          </div>

          <UserCards users={this.sortedUsers} />
        </div>
      </>
    );
  }

  renderSelections() {
    const groups = [
      { key: 'all', count: this.props.users.length },
      { key: 'online', count: this.props.users.filter((user) => user.is_online).length },
    ];

    return (
      <div className='update-streams-v2 update-streams-v2--with-active'>
        <div className='update-streams-v2__container'>
          {
            groups.map((group) => {
              return this.renderOption(group.key, group.count, group.key === this.state.filter);
            })
          }
        </div>
      </div>
    );
  }

  renderSorter() {
    // issue when inferring key type of enum.
    // https://github.com/Microsoft/TypeScript/issues/17800
    const values = Object.keys(SortMode).map((key: keyof typeof SortMode) => {
      return SortMode[key];
    });

    return (
      <Sort
        modifiers={['user-list']}
        onSortSelected={this.onSortSelected}
        sortMode={this.state.sortMode}
        values={values}
      />
    );
  }

  renderOption(key: string, text: string | number, active = false) {
    // FIXME: change all the names
    const modifiers = active ? ['active'] : [];
    let className = osu.classWithModifiers('update-streams-v2__item', modifiers);
    className += ` t-changelog-stream--${key}`;

    return (
      <a
        className={className}
        data-key={key}
        href={osu.updateQueryString(null, { filter: key })}
        key={key}
        onClick={this.optionSelected}
      >
        <div className='update-streams-v2__bar u-changelog-stream--bg' />
        <p className='update-streams-v2__row update-streams-v2__row--name'>{osu.trans(`users.status.${key}`)}</p>
        <p className='update-streams-v2__row update-streams-v2__row--version'>{text}</p>
      </a>
    );
  }

  private get sortedUsers() {
    const users = this.filteredUsers.slice();

    switch (this.state.sortMode) {
      case SortMode.LastVisit:
        return users.sort((x, y) => moment(y.last_visit || 0).unix() - moment(x.last_visit || 0).unix());
    }

    return users.sort((x, y) => x.username.localeCompare(y.username));
  }

  private get filterFromUrl() {
    const url = new URL(location.href);
    return url.searchParams.get('filter') || 'all';
  }

  private get filteredUsers() {
    switch (this.state.filter) {
      case 'online':
        return this.props.users.filter((user) => user.is_online);
    }

    return this.props.users;
  }

  private get sortFromUrl() {
    const url = new URL(location.href);
    // force invalid values to default.
    const value = (url.searchParams.get('sort') || SortMode.LastVisit) as keyof typeof SortMode;
    const sort = SortMode[value] as SortMode;
    return sort || SortMode.LastVisit;
  }
}
