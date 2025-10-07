// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'components/header-v4';
import ShowMoreLink from 'components/show-more-link';
import StringWithComponent from 'components/string-with-component';
import UserGroupEventJson from 'interfaces/user-group-event-json';
import { route } from 'laroute';
import { action, computed, makeObservable, observable, reaction } from 'mobx';
import { disposeOnUnmount, observer } from 'mobx-react';
import * as React from 'react';
import { onError } from 'utils/ajax';
import { trans } from 'utils/lang';
import { navigate } from 'utils/turbolinks';
import { updateQueryString, wikiUrl } from 'utils/url';
import Events from './events';
import groupStore from './group-store';
import GroupHistoryJson from './json';
import SearchForm, { formParamKeys } from './search-form';

interface Props {
  container: HTMLElement;
}

@observer
export default class GroupHistory extends React.Component<Props> {
  @observable private readonly currentParams: GroupHistoryJson['params'];
  @observable private cursor: null | string = null;
  @observable private readonly events: UserGroupEventJson[];
  @observable private loadingMore = false;
  @observable private readonly newParams: GroupHistoryJson['params'];
  private xhr?: JQuery.jqXHR<GroupHistoryJson>;

  @computed
  private get newParamsSameAsCurrent() {
    return formParamKeys.every((key) => this.newParams[key] === this.currentParams[key]);
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);

    const json = JSON.parse(this.props.container.dataset.json ?? '') as GroupHistoryJson;

    groupStore.update(json.groups);
    this.currentParams = json.params;
    this.newParams = { ...this.currentParams };
    this.cursor = json.cursor_string;
    this.events = json.events;

    // If the "group" param doesn't match any group we can show as a select
    // option, set it to null in the new params. This prevents the new params
    // from initially being out of sync with the displayed form controls
    if (json.params.group_id != null && !groupStore.byId.has(json.params.group_id)) {
      this.newParams.group_id = null;
    }

    disposeOnUnmount(this, reaction(
      (): GroupHistoryJson => ({
        cursor_string: this.cursor,
        events: this.events,
        groups: [],
        params: this.currentParams,
      }),
      (newJson) => {
        this.props.container.dataset.json = JSON.stringify(newJson);
      },
    ));
  }

  componentWillUnmount() {
    this.xhr?.abort();
  }

  render() {
    return (
      <>
        <HeaderV4 theme='friends' />
        <div className='osu-page osu-page--generic-compact'>
          <SearchForm
            disabled={this.newParamsSameAsCurrent}
            newParams={this.newParams}
            onSearch={this.onNewSearch}
          />
        </div>
        <div className='osu-page osu-page--generic'>
          <Events events={this.events} />
          <ShowMoreLink
            callback={this.onMore}
            hasMore={this.cursor != null}
            loading={this.loadingMore}
            modifiers='group-history'
          />
        </div>
        <div className='osu-page osu-page--group-history-footer'>
          <StringWithComponent
            mappings={{
              wiki_articles: (
                <a href={wikiUrl('People/Staff_log')}>
                  {trans('group_history.staff_log.wiki_articles')}
                </a>
              ),
            }}
            pattern={trans('group_history.staff_log._')}
          />
        </div>
      </>
    );
  }

  @action
  private readonly onMore = () => {
    if (this.cursor == null || this.xhr != null) {
      return;
    }

    this.loadingMore = true;

    this.xhr = $.ajax(
      route('group-history.index'),
      {
        data: { ...this.currentParams, cursor_string: this.cursor },
        dataType: 'json',
        method: 'GET',
      },
    )
      .done(action((response: GroupHistoryJson) => {
        groupStore.update(response.groups);
        this.cursor = response.cursor_string;
        this.events.push(...response.events);
      }))
      .fail(onError)
      .always(action(() => {
        this.loadingMore = false;
        this.xhr = undefined;
      }));
  };

  @action
  private readonly onNewSearch = () => {
    if (this.newParamsSameAsCurrent) {
      return;
    }

    // Update the query string of the URL when starting a new search. Remove
    // "sort" from the query if it's set to the default
    navigate(updateQueryString(null, {
      ...this.newParams,
      group_id: this.newParams.group_id?.toString(),
      sort: this.newParams.sort === 'id_desc' ? null : this.newParams.sort,
    }));
  };
}
