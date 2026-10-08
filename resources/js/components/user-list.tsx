// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GroupJson from 'interfaces/group-json';
import Ruleset from 'interfaces/ruleset';
import UserJson from 'interfaces/user-json';
import UserRelationJson from 'interfaces/user-relation-json';
import { route } from 'laroute';
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

export type StatusFilter = typeof statusFilters[number];
export type RelationshipFilter = typeof relationshipFilters[number];
type PlayModeFilter = 'all' | Ruleset;
export type SortMode =  typeof sortModes[number];

const statusFilters = ['all', 'online', 'offline'] as const;
const relationshipFilters = ['all', 'mutual', 'non_mutual'] as const;
const playModes: PlayModeFilter[] = ['all', 'osu', 'taiko', 'fruits', 'mania'];
const sortModes = ['last_visit', 'rank', 'username'] as const;


interface Props {
  group?: GroupJson;
  userRelations?: Map<number, UserRelationJson | undefined>;
  users: UserJson[];
}

interface State {
  playMode: PlayModeFilter;
  relationshipFilter: RelationshipFilter;
  sortMode: SortMode;
  statusFilter: StatusFilter;
  viewMode: ViewMode;
}

function rankSortDescending(x: UserJson, y: UserJson) {
  return (x.statistics?.global_rank ?? Number.MAX_VALUE) - (y.statistics?.global_rank ?? Number.MAX_VALUE);
}

export class UserList extends React.PureComponent<Props> {
  state: Readonly<State> = {
    playMode: this.playmodeFromUrl,
    relationshipFilter: this.relationshipFilterFromUrl,
    sortMode: this.sortFromUrl,
    statusFilter: this.statusFilterFromUrl,
    viewMode: this.viewFromUrl,
  };

  private get statusFilterFromUrl() {
    return this.getAllowedQueryStringValue(
      statusFilters,
      currentUrlParams().get('filter'),
      core.userPreferences.get('user_list_filter'),
    );
  }

  private get relationshipFilterFromUrl() {
    return this.getAllowedQueryStringValue(
      relationshipFilters,
      currentUrlParams().get('relationship'),
      core.userPreferences.get('user_list_relationship_filter'),
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
    const users = this.getFilteredUsers(this.state.statusFilter, this.state.relationshipFilter).slice();

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

  optionSelected = (event: React.SyntheticEvent) => {
    event.preventDefault();
    const key = (event.currentTarget as HTMLElement).dataset.key;
    const url = updateQueryString(null, { filter: key }) ;

    updateHistory(url, 'push');
    this.setState({ statusFilter: key }, () => {
      core.userPreferences.set('user_list_filter', this.state.statusFilter);
    });
  };

  playmodeSelected = (event: React.SyntheticEvent) => {
    const value = (event.currentTarget as HTMLElement).dataset.value;
    const url = updateQueryString(null, { mode: value });

    updateHistory(url, 'push');
    this.setState({ playMode: value });
  };

  relationshipSelected = (event: React.SyntheticEvent) => {
    event.preventDefault();
    const key = (event.currentTarget as HTMLElement).dataset.key;
    const url = updateQueryString(null, { relationship: key }) ;

    updateHistory(url, 'push');
    this.setState({ relationshipFilter: key }, () => {
      core.userPreferences.set('user_list_relationship_filter', this.state.relationshipFilter);
    });
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
            {this.props.group == null && (
              <div className='user-list__toolbar-row'>
                <div className='user-list__toolbar-item'>
                  {this.renderRelationshipFilter()}
                </div>
              </div>
            )}
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
        href={updateQueryString(null, { filter: key })}
        onClick={this.optionSelected}
      >
        <div className='update-streams-v2__bar u-changelog-stream--bg' />
        <p className='update-streams-v2__row update-streams-v2__row--name'>{trans(`users.status.${key}`)}</p>
        <p className='update-streams-v2__row update-streams-v2__row--version'>{text}</p>
      </a>
    );
  }

  renderRelationshipFilter() {
    const relationshipButtons = relationshipFilters.map((mode) => (
      <button
        key={mode}
        className={classWithModifiers('user-list__view-mode', this.state.relationshipFilter === mode ? ['active'] : [])}
        data-key={mode}
        data-value={mode}
        onClick={this.relationshipSelected}
        title={trans(`users.relationship.${mode}`)}
      >
        {mode === 'all' ?
          <span>{trans('users.relationship.all')}</span>
          :
          <span className={`fas fa-user${mode === 'mutual' ? '-friends': ''}`} />
        }
      </button>
    ));

    return (
      <div className='user-list__view-modes'>
        <span className='user-list__view-mode-title'>{trans('users.relationship.title')}</span> {relationshipButtons}
      </div>
    );
  }

  renderSelections() {
    return (
      <div className='update-streams-v2 update-streams-v2--with-active update-streams-v2--user-list'>
        <div className='update-streams-v2__container'>
          {
            statusFilters.map((filter) => this.renderOption(filter, this.getFilteredUsers(filter, this.state.relationshipFilter).length, filter === this.state.statusFilter))
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

  private filterUsersByRelationship(users: UserJson[], userRelations: Map<number, UserRelationJson | undefined>, filter: RelationshipFilter) {
    switch (filter) {
      case 'mutual':
        return users.filter((user) => userRelations.get(user.id)?.mutual);
      case 'non_mutual':
        return users.filter((user) => !userRelations.get(user.id)?.mutual);
      default:
        return users;
    }
  }

  private filterUsersByStatus(users: UserJson[], filter: StatusFilter) {
    switch (filter) {
      case 'online':
        return users.filter((user) => user.is_online);
      case 'offline':
        return users.filter((user) => !user.is_online);
      default:
        return users;
    }
  }

  private getAllowedQueryStringValue<T>(allowed: readonly T[], value: unknown, fallback: unknown) {
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

  private getFilteredUsers(statusFilter: StatusFilter, relationshipFilter: RelationshipFilter) {
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
    if (this.props.group == null && this.props.userRelations != null) {
      users = this.filterUsersByRelationship(users, this.props.userRelations, relationshipFilter);
    }
    return this.filterUsersByStatus(users, statusFilter);
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
