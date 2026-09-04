// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GroupJson from 'interfaces/group-json';
import Ruleset from 'interfaces/ruleset';
import UserJson from 'interfaces/user-json';
import UserPreferencesJson from 'interfaces/user-preferences-json';
import { route } from 'laroute';
import { observer } from 'mobx-react';
import { usernameSortAscending } from 'models/user';
import * as moment from 'moment';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import { currentUrlParams, updateHistory } from 'utils/turbolinks';
import { updateQueryString } from 'utils/url';
import BigButton from './big-button';
import { Sort } from './sort';
import { ViewMode, viewModes } from './user-card';
import { UserCards } from './user-cards';

export type Filter = 'all' | 'online' |'offline';
export type RelationshipFilter = 'all' | 'mutual' |'non_mutual';
type PlayModeFilter = 'all' | Ruleset;
export type SortMode = 'last_visit' | 'rank' | 'username';

const statusFilters: Filter[] = ['all', 'online', 'offline'];
const relationshipFilters: RelationshipFilter[] = ['all', 'mutual', 'non_mutual'];
const playModes: PlayModeFilter[] = ['all', 'osu', 'taiko', 'fruits', 'mania'];
const sortModes: SortMode[] = ['last_visit', 'rank', 'username'];

interface UserFilterDefinition {
  preferenceKey: keyof UserPreferencesJson;
  queryParameter: string;
  translationKey: string;
}

const filterDefinitions: Record<keyof UserFilters, UserFilterDefinition> = {
  relationshipFilter: {
    preferenceKey: 'user_list_relationship_filter',
    queryParameter: 'relationship_filter',
    translationKey: 'relationship',
  },
  statusFilter: {
    preferenceKey: 'user_list_filter',
    queryParameter: 'filter',
    translationKey: 'status',
  },
};

interface Props {
  group?: GroupJson;
  users: UserJson[];
}

interface UserFilters {
  relationshipFilter: RelationshipFilter;
  statusFilter: Filter;
}

interface State {
  filters: UserFilters;
  playMode: PlayModeFilter;
  sortMode: SortMode;
  viewMode: ViewMode;
}

function rankSortDescending(x: UserJson, y: UserJson) {
  return (x.statistics?.global_rank ?? Number.MAX_VALUE) - (y.statistics?.global_rank ?? Number.MAX_VALUE);
}

@observer
export class UserList extends React.PureComponent<Props> {
  state: Readonly<State> = {
    filters: this.filterFromUrl,
    playMode: this.playmodeFromUrl,
    sortMode: this.sortFromUrl,
    viewMode: this.viewFromUrl,
  };

  private get filterFromUrl() {
    const statusFilter = this.getAllowedQueryStringValue(
      statusFilters,
      currentUrlParams().get('filter'),
      core.userPreferences.get('user_list_filter'),
    );
    const relationshipFilter = this.getAllowedQueryStringValue(
      relationshipFilters,
      currentUrlParams().get('relationship_filter'),
      core.userPreferences.get('user_list_relationship_filter'),
    );
    return { relationshipFilter, statusFilter };
  }

  private get playmodeFromUrl() {
    return this.getAllowedQueryStringValue(
      playModes,
      currentUrlParams().get('mode'),
      'all',
    );
  }

  private get sortedUsers() {
    const users = this.getFilteredUsers(this.state.filters).slice();

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

          return moment(y.last_visit ?? 0).diff(moment(x.last_visit ?? 0));
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
    const url = updateQueryString(null, { sort: value });

    updateHistory(url, 'push');
    this.setState({ sortMode: value }, () => {
      core.userPreferences.set('user_list_sort', this.state.sortMode);
    });
  };

  onViewSelected = (event: React.SyntheticEvent) => {
    const value = (event.currentTarget as HTMLElement).dataset.value;
    const url = updateQueryString(null, { view: value });

    updateHistory(url, 'push');
    this.setState({ viewMode: value }, () => {
      core.userPreferences.set('user_list_view', this.state.viewMode);
    });
  };

  optionSelected = (filterKey: keyof UserFilters) => (event: React.SyntheticEvent) => {
    event.preventDefault();
    const key = (event.currentTarget as HTMLElement).dataset.key;
    const url = updateQueryString(null, { [filterDefinitions[filterKey].queryParameter]: key }) ;

    updateHistory(url, 'push');
    this.setState({ filters: { ...this.state.filters, [filterKey]: key } }, () => {
      core.userPreferences.set(filterDefinitions[filterKey].preferenceKey, this.state.filters[filterKey]);
    });
  };

  playmodeSelected = (event: React.SyntheticEvent) => {
    const value = (event.currentTarget as HTMLElement).dataset.value;
    const url = updateQueryString(null, { mode: value });

    updateHistory(url, 'push');
    this.setState({ playMode: value });
  };

  render(): React.ReactNode {
    return (
      <>
        {this.renderSelections()}

        <div className='user-list'>
          {this.props.group != null && (
            <h1 className='user-list__title'>
              {this.props.group.name}
              <BigButton
                href={route('group-history.index', { group_id: this.props.group.id })}
                icon='fas fa-history'
                modifiers='rounded-thin'
                text={trans('group_history.view')}
              />
            </h1>
          )}

          {this.props.group?.description != null && (
            <div
              dangerouslySetInnerHTML={{ __html: this.props.group.description.html }}
              className='user-list__description'
            />
          )}

          <div className='user-list__toolbar'>
            {this.props.group?.has_playmodes && (
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

  renderOption(key: string, text: string | number, filterKey: keyof UserFilters, active = false) {
    // FIXME: change all the names
    const modifiers = active ? ['active'] : [];
    let className = classWithModifiers('update-streams-v2__item', modifiers);
    className += ` t-changelog-stream--${key}`;

    return (
      <a
        key={key}
        className={className}
        data-key={key}
        href={updateQueryString(null, { [filterDefinitions[filterKey].queryParameter]: key })}
        onClick={this.optionSelected(filterKey)}
      >
        <div className='update-streams-v2__bar u-changelog-stream--bg' />
        <p className='update-streams-v2__row update-streams-v2__row--name'>{trans(`users.${filterDefinitions[filterKey].translationKey}.${key}`)}</p>
        <p className='update-streams-v2__row update-streams-v2__row--version'>{text}</p>
      </a>
    );
  }

  renderSelections() {
    return (
      <div className='update-streams-v2 update-streams-v2--with-active update-streams-v2--user-list'>
        <div className='update-streams-v2__container'>
          {
            statusFilters.map((filter) => this.renderOption(filter, this.getFilteredUsers({ ...this.state.filters, statusFilter: filter }).length, 'statusFilter', filter === this.state.filters.statusFilter))
          }
        </div>
        <div className='update-streams-v2__container'>
          {
            relationshipFilters.map((filter) => this.renderOption(filter, this.getFilteredUsers({ ...this.state.filters, relationshipFilter: filter }).length, 'relationshipFilter', filter === this.state.filters.relationshipFilter))
          }
        </div>
      </div>
    );
  }

  renderSorter() {
    return (
      <Sort
        currentValue={this.state.sortMode}
        modifiers='user-list'
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
          title={trans('users.view_mode.card')}
        >
          <span className='fas fa-square' />
        </button>
        <button
          className={classWithModifiers('user-list__view-mode', this.state.viewMode === 'list' ? ['active'] : [])}
          data-value='list'
          onClick={this.onViewSelected}
          title={trans('users.view_mode.list')}
        >
          <span className='fas fa-bars' />
        </button>
        <button
          className={classWithModifiers('user-list__view-mode', this.state.viewMode === 'brick' ? ['active'] : [])}
          data-value='brick'
          onClick={this.onViewSelected}
          title={trans('users.view_mode.brick')}
        >
          <span className='fas fa-th' />
        </button>
      </div>
    );
  }

  private filterUsersByRelationship(users: UserJson[], filter: RelationshipFilter) {
    switch (filter) {
      case 'mutual':
        return users.filter((user) => core.currentUserModel.friends.get(user.id)?.mutual);
      case 'non_mutual':
        return users.filter((user) => !core.currentUserModel.friends.get(user.id)?.mutual);
      default:
        return users;
    }
  }

  private filterUsersByStatus(users: UserJson[], filter: Filter) {
    switch (filter) {
      case 'online':
        return users.filter((user) => user.is_online);
      case 'offline':
        return users.filter((user) => !user.is_online);
      default:
        return users;
    }
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

  private getFilteredUsers(filters: UserFilters) {
    // TODO: should be cached or something
    let users = this.props.users.slice();
    const playmode = this.state.playMode;
    if (playmode !== 'all' && this.props.group?.has_playmodes) {
      const filterGroupId = this.props.group.id;
      users = users.filter((user) => (
        user.groups
          ?.find((group) => group.id === filterGroupId)
          ?.playmodes
          ?.includes(playmode)
      ));
    }
    users = this.filterUsersByStatus(users, filters.statusFilter);
    return this.filterUsersByRelationship(users, filters.relationshipFilter);
  }

  private renderPlaymodeFilter() {
    const playmodeButtons = playModes.map((mode) => (
      <button
        key={mode}
        className={classWithModifiers('user-list__view-mode', this.state.playMode === mode ? ['active'] : [])}
        data-value={mode}
        onClick={this.playmodeSelected}
        title={trans(`beatmaps.mode.${mode}`)}
      >
        {mode === 'all' ?
          <span>{trans('beatmaps.mode.all')}</span>
          :
          <span className={`fal fa-extra-mode-${mode}`} />
        }
      </button>
    ));

    return (
      <div className='user-list__view-modes'>
        <span className='user-list__view-mode-title'>{trans('users.filtering.by_game_mode')}</span> {playmodeButtons}
      </div>
    );
  }
}
