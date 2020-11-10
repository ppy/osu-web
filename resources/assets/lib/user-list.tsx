// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from 'interfaces/game-mode';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import * as _ from 'lodash';
import * as moment from 'moment';
import * as React from 'react';
import { Sort } from 'sort';
import { ViewMode } from 'user-card';
import { UserCards } from 'user-cards';

type Filter = 'all' | 'online' | 'offline';
type PlayModeFilter = 'all' | GameMode;
type SortMode = 'last_visit' | 'rank' | 'username';

const filters: Filter[] = ['all', 'online', 'offline'];
const playModes: PlayModeFilter[] = ['all', 'osu', 'taiko', 'fruits', 'mania'];
const sortModes: SortMode[] = ['last_visit', 'rank', 'username'];
const viewModes: ViewMode[] = ['card', 'list', 'brick'];

interface Props {
  playmodeFilter?: boolean;
  title?: string;
  users: UserJson[];
}

interface State {
  filter: Filter;
  playMode: PlayModeFilter;
  sortMode: SortMode;
  viewMode: ViewMode;
}

function rankSortDescending(x: UserJson, y: UserJson) {
  if (x.current_mode_rank != null && y.current_mode_rank != null) {
    return x.current_mode_rank > y.current_mode_rank ? 1 : -1;
  } else if (x.current_mode_rank === null) {
    return 1;
  } else {
    return -1;
  }
}

function usernameSortAscending(x: UserJson, y: UserJson) {
  return x.username.localeCompare(y.username);
}

export class UserList extends React.PureComponent<Props> {
  readonly state: State = {
    filter: this.filterFromUrl,
    playMode: this.playmodeFromUrl,
    sortMode: this.sortFromUrl,
    viewMode: this.viewFromUrl,
  };

  private get filterFromUrl() {
    const url = new URL(location.href);

    return this.getAllowedQueryStringValue(
      filters,
      url.searchParams.get('filter'),
      currentUser?.user_preferences?.user_list_filter,
    );
  }

  private get playmodeFromUrl() {
    const url = new URL(location.href);

    return this.getAllowedQueryStringValue(
      playModes,
      url.searchParams.get('mode'),
      'all',
    );
  }

  private get sortedUsers() {
    const users = this.getFilteredUsers(this.state.filter).slice();

    switch (this.state.sortMode) {
      case 'rank':
        return users.sort(rankSortDescending);

      case 'username':
        return users.sort(usernameSortAscending);

      default:
        return users.sort((x, y) => {
          if (x.is_online && y.is_online) {
            return usernameSortAscending(x, y);
          }

          if (x.is_online || y.is_online) {
            return x.is_online ? -1 : 1;
          }

          return moment(y.last_visit || 0).diff(moment(x.last_visit || 0));
        });
    }
  }

  private get sortFromUrl() {
    const url = new URL(location.href);

    return this.getAllowedQueryStringValue(
      sortModes,
      url.searchParams.get('sort'),
      currentUser?.user_preferences?.user_list_sort,
    );
  }

  private get viewFromUrl() {
    const url = new URL(location.href);

    return this.getAllowedQueryStringValue(
      viewModes,
      url.searchParams.get('view'),
      currentUser?.user_preferences?.user_list_view,
    );
  }

  handleSortChange = (event: React.SyntheticEvent) => {
    const value = (event.currentTarget as HTMLElement).dataset.value;
    const url = osu.updateQueryString(null, { sort: value });

    Turbolinks.controller.advanceHistory(url);
    this.setState({ sortMode: value }, this.saveOptions);
  }

  onViewSelected = (event: React.SyntheticEvent) => {
    const value = (event.currentTarget as HTMLElement).dataset.value;
    const url = osu.updateQueryString(null, { view: value });

    Turbolinks.controller.advanceHistory(url);
    this.setState({ viewMode: value }, this.saveOptions);
  }

  optionSelected = (event: React.SyntheticEvent) => {
    event.preventDefault();
    const key = (event.currentTarget as HTMLElement).dataset.key;
    const url = osu.updateQueryString(null, { filter: key });

    Turbolinks.controller.advanceHistory(url);
    this.setState({ filter: key }, this.saveOptions);
  }

  playmodeSelected = (event: React.SyntheticEvent) => {
    const value = (event.currentTarget as HTMLElement).dataset.value;
    const url = osu.updateQueryString(null, { mode: value });

    Turbolinks.controller.advanceHistory(url);
    this.setState({ playMode: value });
  }

  render(): React.ReactNode {
    return (
      <>
        {this.renderSelections()}

        <div className='user-list'>
          {this.props.title != null && (
            <h1 className='user-list__title'>{this.props.title}</h1>
          )}

          <div className='user-list__toolbar'>
            {this.props.playmodeFilter && (
              <div className='user-list__toolbar-row'>
                <div className='user-list__toolbar-item'>{this.renderPlaymodeFilter()}</div>
              </div>
            )}
            <div className='user-list__toolbar-row'>
              <div className='user-list__toolbar-item'>{this.renderSorter()}</div>
              <div className='user-list__toolbar-item'>{this.renderViewMode()}</div>
            </div>
          </div>

          <div className='user-list__items'>
            <UserCards users={this.sortedUsers} viewMode={this.state.viewMode} />
          </div>
        </div>
      </>
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

  renderSelections() {
    return (
      <div className='update-streams-v2 update-streams-v2--with-active update-streams-v2--user-list'>
        <div className='update-streams-v2__container'>
          {
            filters.map((filter) => {
              return this.renderOption(filter, this.getFilteredUsers(filter).length, filter === this.state.filter);
            })
          }
        </div>
      </div>
    );
  }

  renderSorter() {
    return (
      <Sort
        modifiers={['user-list']}
        onChange={this.handleSortChange}
        currentValue={this.state.sortMode}
        values={sortModes}
      />
    );
  }

  renderViewMode() {
    return (
      <div className='user-list__view-modes'>
        <button
          className={osu.classWithModifiers('user-list__view-mode', this.state.viewMode === 'card' ? ['active'] : [])}
          data-value='card'
          title={osu.trans('users.view_mode.card')}
          onClick={this.onViewSelected}
        >
          <span className='fas fa-square' />
        </button>
        <button
          className={osu.classWithModifiers('user-list__view-mode', this.state.viewMode === 'list' ? ['active'] : [])}
          data-value='list'
          title={osu.trans('users.view_mode.list')}
          onClick={this.onViewSelected}
        >
          <span className='fas fa-bars' />
        </button>
        <button
          className={osu.classWithModifiers('user-list__view-mode', this.state.viewMode === 'brick' ? ['active'] : [])}
          data-value='brick'
          title={osu.trans('users.view_mode.brick')}
          onClick={this.onViewSelected}
        >
          <span className='fas fa-th' />
        </button>
      </div>
    );
  }

  private getAllowedQueryStringValue<T>(allowed: T[], value: unknown, fallback: unknown) {
    const casted = value as T;
    if (allowed.indexOf(casted) > -1) {
      return casted;
    }

    const fallbackCasted = fallback as T;
    if (allowed.indexOf(fallbackCasted) > -1) {
      return fallbackCasted;
    }

    return allowed[0];
  }

  private getFilteredUsers(filter: Filter) {
    // TODO: should be cached or something
    let users = this.props.users.slice();
    if (this.props.playmodeFilter && this.state.playMode !== 'all') {
      users = users.filter((user) => {
        if (user.groups && user.groups.length > 0) {
          return user.groups.some((group) => group.playmodes && (group.playmodes as PlayModeFilter[]).includes(this.state.playMode));
        } else {
          return false;
        }
      });
    }

    switch (filter) {
      case 'online':
        return users.filter((user) => user.is_online);
      case 'offline':
        return users.filter((user) => !user.is_online);
      default:
        return users;
    }
  }

  private renderPlaymodeFilter() {
    const playmodeButtons = playModes.map((mode) => {
      return (
        <button
          className={osu.classWithModifiers('user-list__view-mode', this.state.playMode === mode ? ['active'] : [])}
          data-value={mode}
          title={osu.trans(`beatmaps.mode.${mode}`)}
          onClick={this.playmodeSelected}
          key={mode}
        >
          {mode === 'all' ?
            <span>{osu.trans('beatmaps.mode.all')}</span>
            :
            <span className={`fal fa-extra-mode-${mode}`}/>
          }
        </button>
      );
    });

    return (
      <div className='user-list__view-modes'>
        <span className='user-list__view-mode-title'>{osu.trans('users.filtering.by_game_mode')}</span> {playmodeButtons}
      </div>
    );
  }

  private saveOptions() {
    if (currentUser.id == null) {
      return;
    }

    $.ajax(route('account.options'), {
      dataType: 'JSON',
      method: 'PUT',

      data: { user_profile_customization: {
        user_list_filter: this.state.filter,
        user_list_sort: this.state.sortMode,
        user_list_view: this.state.viewMode,
      } },
    }).done((user: UserJson) => $.publish('user:update', user));
  }
}
