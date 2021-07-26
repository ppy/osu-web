// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from 'interfaces/game-mode';
import UserJson from 'interfaces/user-json';
import * as _ from 'lodash';
import * as moment from 'moment';
import * as osu from 'osu-common';
import core from 'osu-core-singleton';
import * as React from 'react';
import { Sort } from 'sort';
import { ViewMode, viewModes } from 'user-card';
import { UserCards } from 'user-cards';
import { classWithModifiers } from 'utils/css';
import { currentUrlParams } from 'utils/turbolinks';

export type Filter = 'all' | 'online' | 'offline';
type PlayModeFilter = 'all' | GameMode;
export type SortMode = 'last_visit' | 'rank' | 'username';

const filters: Filter[] = ['all', 'online', 'offline'];
const playModes: PlayModeFilter[] = ['all', 'osu', 'taiko', 'fruits', 'mania'];
const sortModes: SortMode[] = ['last_visit', 'rank', 'username'];

interface Props {
  descriptionHtml?: string;
  playmodeFilter?: boolean;
  playmodeFilterGroupId?: number;
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
  return (x.statistics?.global_rank ?? Number.MAX_VALUE) - (y.statistics?.global_rank ?? Number.MAX_VALUE);
}

function usernameSortAscending(x: UserJson, y: UserJson) {
  return x.username.localeCompare(y.username);
}

export class UserList extends React.PureComponent<Props> {
  state: Readonly<State> = {
    filter: this.filterFromUrl,
    playMode: this.playmodeFromUrl,
    sortMode: this.sortFromUrl,
    viewMode: this.viewFromUrl,
  };

  private get filterFromUrl() {
    return this.getAllowedQueryStringValue(
      filters,
      currentUrlParams().get('filter'),
      core.userPreferences.get('user_list_filter'),
    );
  }

  private get playmodeFromUrl() {
    return this.getAllowedQueryStringValue(
      playModes,
      currentUrlParams().get('mode'),
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
    return this.getAllowedQueryStringValue(
      sortModes,
      currentUrlParams().get('sort'),
      core.userPreferences.get('user_list_sort'),
    );
  }

  private get viewFromUrl() {
    return this.getAllowedQueryStringValue(
      viewModes,
      currentUrlParams().get('view'),
      core.userPreferences.get('user_list_view'),
    );
  }

  handleSortChange = (event: React.SyntheticEvent) => {
    const value = (event.currentTarget as HTMLElement).dataset.value;
    const url = osu.updateQueryString(null, { sort: value });

    Turbolinks.controller.advanceHistory(url);
    this.setState({ sortMode: value }, () => {
      core.userPreferences.set('user_list_sort', this.state.sortMode);
    });
  };

  onViewSelected = (event: React.SyntheticEvent) => {
    const value = (event.currentTarget as HTMLElement).dataset.value;
    const url = osu.updateQueryString(null, { view: value });

    Turbolinks.controller.advanceHistory(url);
    this.setState({ viewMode: value }, () => {
      core.userPreferences.set('user_list_view', this.state.viewMode);
    });
  };

  optionSelected = (event: React.SyntheticEvent) => {
    event.preventDefault();
    const key = (event.currentTarget as HTMLElement).dataset.key;
    const url = osu.updateQueryString(null, { filter: key });

    Turbolinks.controller.advanceHistory(url);
    this.setState({ filter: key }, () => {
      core.userPreferences.set('user_list_filter', this.state.filter);
    });
  };

  playmodeSelected = (event: React.SyntheticEvent) => {
    const value = (event.currentTarget as HTMLElement).dataset.value;
    const url = osu.updateQueryString(null, { mode: value });

    Turbolinks.controller.advanceHistory(url);
    this.setState({ playMode: value });
  };

  render(): React.ReactNode {
    return (
      <>
        {this.renderSelections()}

        <div className='user-list'>
          {this.props.title != null && (
            <h1 className='user-list__title'>{this.props.title}</h1>
          )}

          {this.props.descriptionHtml != null && (
            <div dangerouslySetInnerHTML={{ __html: this.props.descriptionHtml }} className='user-list__description' />
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
    let className = classWithModifiers('update-streams-v2__item', modifiers);
    className += ` t-changelog-stream--${key}`;

    return (
      <a
        key={key}
        className={className}
        data-key={key}
        href={osu.updateQueryString(null, { filter: key })}
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
            filters.map((filter) => this.renderOption(filter, this.getFilteredUsers(filter).length, filter === this.state.filter))
          }
        </div>
      </div>
    );
  }

  renderSorter() {
    return (
      <Sort
        currentValue={this.state.sortMode}
        modifiers={['user-list']}
        onChange={this.handleSortChange}
        values={sortModes}
      />
    );
  }

  renderViewMode() {
    return (
      <div className='user-list__view-modes'>
        <button
          className={classWithModifiers('user-list__view-mode', this.state.viewMode === 'card' ? ['active'] : [])}
          data-value='card'
          onClick={this.onViewSelected}
          title={osu.trans('users.view_mode.card')}
        >
          <span className='fas fa-square' />
        </button>
        <button
          className={classWithModifiers('user-list__view-mode', this.state.viewMode === 'list' ? ['active'] : [])}
          data-value='list'
          onClick={this.onViewSelected}
          title={osu.trans('users.view_mode.list')}
        >
          <span className='fas fa-bars' />
        </button>
        <button
          className={classWithModifiers('user-list__view-mode', this.state.viewMode === 'brick' ? ['active'] : [])}
          data-value='brick'
          onClick={this.onViewSelected}
          title={osu.trans('users.view_mode.brick')}
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
    const playmode = this.state.playMode;
    if (this.props.playmodeFilter && playmode !== 'all') {
      users = users.filter((user) => {
        if (user.groups && user.groups.length > 0) {
          if (this.props.playmodeFilterGroupId != null) {
            const filterGroup = user.groups.find((group) => group.id === this.props.playmodeFilterGroupId);
            return filterGroup?.playmodes?.includes(playmode);
          }

          return user.groups.some((group) => group.playmodes?.includes(playmode));
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
    const playmodeButtons = playModes.map((mode) => (
      <button
        key={mode}
        className={classWithModifiers('user-list__view-mode', this.state.playMode === mode ? ['active'] : [])}
        data-value={mode}
        onClick={this.playmodeSelected}
        title={osu.trans(`beatmaps.mode.${mode}`)}
      >
        {mode === 'all' ?
          <span>{osu.trans('beatmaps.mode.all')}</span>
          :
          <span className={`fal fa-extra-mode-${mode}`} />
        }
      </button>
    ));

    return (
      <div className='user-list__view-modes'>
        <span className='user-list__view-mode-title'>{osu.trans('users.filtering.by_game_mode')}</span> {playmodeButtons}
      </div>
    );
  }
}
