// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'components/header-v4';
import ShowMoreLink from 'components/show-more-link';
import StringWithComponent from 'components/string-with-component';
import UserGroupEventJson from 'interfaces/user-group-event-json';
import { route } from 'laroute';
import { omit } from 'lodash';
import { action, autorun, computed, makeObservable, observable } from 'mobx';
import { disposeOnUnmount, observer } from 'mobx-react';
import * as React from 'react';
import { onErrorWithCallback } from 'utils/ajax';
import { parseJson, storeJson } from 'utils/json';
import { trans } from 'utils/lang';
import { navigate } from 'utils/turbolinks';
import { updateQueryString, wikiUrl } from 'utils/url';
import Events from './events';
import groupStore from './group-store';
import GroupHistoryJson from './json';
import SearchForm from './search-form';

type MoreParams = GroupHistoryJson['params'] & { cursor_string: string };

export const formParamKeys = ['group', 'max_date', 'min_date', 'user'] as const;
const jsonId = 'json-group-history';

@observer
export default class Main extends React.Component {
  @observable private currentParams: GroupHistoryJson['params'];
  @observable private events: UserGroupEventJson[];
  @observable private loading: 'more' | 'new' | false = false;
  @observable private moreParams!: MoreParams | null;
  @observable private readonly newParams: GroupHistoryJson['params'];
  private xhr?: JQuery.jqXHR<GroupHistoryJson>;

  @computed
  private get newParamsSameAsCurrent() {
    return formParamKeys.every((key) => this.newParams[key] === this.currentParams[key]);
  }

  constructor(props: Record<string, never>) {
    super(props);
    makeObservable(this);

    const json = parseJson<GroupHistoryJson>(jsonId);

    groupStore.update(json.groups);
    this.currentParams = json.params;
    this.events = json.events;
    this.newParams = { ...this.currentParams };
    this.setMoreParamsFromJson(json);

    // If the "group" param doesn't match any group we can show as a select
    // option, set it to null in the new params. This prevents the new params
    // from initially being out of sync with the displayed form controls
    if (json.params.group != null && !groupStore.byIdentifier.has(json.params.group)) {
      this.newParams.group = null;
    }

    disposeOnUnmount(this, autorun(() => storeJson<GroupHistoryJson>(jsonId, {
      cursor_string: this.moreParams?.cursor_string ?? null,
      events: this.events,
      groups: groupStore.all,
      params: this.currentParams,
    })));
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
            loading={this.loading === 'new'}
            newParams={this.newParams}
            onSearch={this.onNewSearch}
          />
        </div>
        <div className='osu-page osu-page--generic'>
          <Events events={this.events} />
          <ShowMoreLink
            callback={this.onMore}
            hasMore={this.moreParams != null}
            loading={this.loading === 'more'}
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
  private loadEvents(params: GroupHistoryJson['params'] | MoreParams) {
    this.xhr?.abort();
    this.currentParams = omit(params, 'cursor_string');
    this.loading = 'cursor_string' in params ? 'more' : 'new';

    this.xhr = $.ajax(
      route('group-history.index'),
      {
        data: params,
        dataType: 'json',
        method: 'GET',
      },
    )
      .done(action((response: GroupHistoryJson) => {
        groupStore.update(response.groups);
        this.setMoreParamsFromJson(response);

        if (this.loading === 'new') {
          this.events = response.events;
        } else {
          this.events.push(...response.events);
        }
      }))
      .fail(onErrorWithCallback(() => this.loadEvents(params)))
      .always(action(() => this.loading = false));
  }

  private readonly onMore = () => {
    if (this.moreParams != null) {
      this.loadEvents(this.moreParams);
    }
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
      sort: this.newParams.sort === 'id_desc' ? null : this.newParams.sort,
    }));
  };

  private setMoreParamsFromJson(json: GroupHistoryJson) {
    this.moreParams = json.cursor_string == null
      ? null
      : { ...json.params, cursor_string: json.cursor_string };
  }
}
