// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'components/header-v4';
import ShowMoreLink from 'components/show-more-link';
import StringWithComponent from 'components/string-with-component';
import UserGroupEventJson from 'interfaces/user-group-event-json';
import { route } from 'laroute';
import { IReactionDisposer, action, autorun, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { onErrorWithCallback } from 'utils/ajax';
import { trans } from 'utils/lang';
import { updateQueryString, wikiUrl } from 'utils/url';
import Events from './events';
import groupStore from './group-store';
import GroupHistoryJson from './json';
import SearchForm from './search-form';

@observer
export default class Main extends React.Component<GroupHistoryJson> {
  @observable private currentParams: GroupHistoryJson['params'];
  @observable private cursorString: string | null;
  private readonly disposeQueryStringUpdater: IReactionDisposer;
  @observable private events: UserGroupEventJson[];
  @observable private loading?: 'more' | 'new';
  @observable private readonly newParams: GroupHistoryJson['params'];
  private xhr?: JQuery.jqXHR<GroupHistoryJson>;

  constructor(props: GroupHistoryJson) {
    super(props);

    groupStore.update(props.groups);
    this.currentParams = props.params;
    this.cursorString = props.cursor_string;
    this.events = props.events;
    this.newParams = { ...this.currentParams };

    // Update the query string of the URL whenever the current params are
    // modified. Remove "sort" from the query if it's set to the default
    this.disposeQueryStringUpdater = autorun(() => {
      const params = {
        ...this.currentParams,
        sort: this.currentParams.sort === 'id_desc' ? null : this.currentParams.sort,
      };

      history.replaceState(history.state, '', updateQueryString(null, params));
    });

    // If the "group" param doesn't match any group we can show as a select
    // option, set it to null in the new params. This prevents the new params
    // from initially being out of sync with the displayed form controls
    if (props.params.group != null && !groupStore.byIdentifier.has(props.params.group)) {
      this.newParams.group = null;
    }

    makeObservable(this);
  }

  componentWillUnmount() {
    this.disposeQueryStringUpdater();
    this.xhr?.abort();
  }

  render() {
    return (
      <>
        <HeaderV4 theme='friends' />
        <div className='osu-page osu-page--generic-compact'>
          <SearchForm
            currentParams={this.currentParams}
            loading={this.loading === 'new'}
            newParams={this.newParams}
            onSearch={this.onSearch}
          />
        </div>
        <div className='osu-page osu-page--generic'>
          <Events events={this.events} />
          <ShowMoreLink
            callback={this.onShowMore}
            hasMore={this.cursorString != null}
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
  private loadEvents(params: GroupHistoryJson['params'], cursorString?: string) {
    this.xhr?.abort();
    this.loading = cursorString == null ? 'new' : 'more';

    this.xhr = $.ajax(
      route('group-history.index'),
      {
        data: { ...params, cursor_string: cursorString },
        dataType: 'json',
        method: 'GET',
      },
    )
      .done(action((response: GroupHistoryJson) => {
        groupStore.update(response.groups);
        this.currentParams = response.params;
        this.cursorString = response.cursor_string;

        if (cursorString == null) {
          this.events = response.events;
        } else {
          this.events.push(...response.events);
        }
      }))
      .fail(onErrorWithCallback(() => this.loadEvents(params, cursorString)))
      .always(action(() => this.loading = undefined));
  }

  private readonly onSearch = () => this.loadEvents(this.newParams);

  private readonly onShowMore = () => {
    if (this.cursorString != null) {
      this.loadEvents(this.currentParams, this.cursorString);
    }
  };
}
