// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'components/header-v4';
import ShowMoreLink from 'components/show-more-link';
import StringWithComponent from 'components/string-with-component';
import UserGroupEventJson from 'interfaces/user-group-event-json';
import { route } from 'laroute';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { onErrorWithCallback } from 'utils/ajax';
import { trans } from 'utils/lang';
import { wikiUrl } from 'utils/url';
import Events from './events';
import groupStore from './group-store';
import GroupHistoryJson from './json';
import { getQueryFromUrl, GroupHistoryQuery, setUrlFromQuery } from './query';
import SearchForm from './search-form';

interface Props {
  cursorString: string | null;
  events: UserGroupEventJson[];
}

@observer
export default class Main extends React.Component<Props> {
  @observable private currentQuery: GroupHistoryQuery;
  @observable private cursorString: string | null;
  @observable private events: UserGroupEventJson[];
  @observable private loading?: 'more' | 'new';
  @observable private newQuery: GroupHistoryQuery;
  private xhr?: JQuery.jqXHR<GroupHistoryJson>;

  constructor(props: Props) {
    super(props);

    const { parseError, query } = getQueryFromUrl();

    this.currentQuery = query;
    this.cursorString = props.cursorString;
    this.events = props.events;
    this.newQuery = { ...this.currentQuery };

    makeObservable(this);

    if (parseError) {
      this.onSearch();
    }
  }

  componentWillUnmount() {
    this.xhr?.abort();
  }

  render() {
    return (
      <>
        <HeaderV4 theme='friends' />
        <div className='osu-page osu-page--header'>
          <SearchForm
            currentQuery={this.currentQuery}
            loading={this.loading === 'new'}
            newQuery={this.newQuery}
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
          <p className='group-history__staff-log'>
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
          </p>
        </div>
      </>
    );
  }

  @action
  private loadEvents(query: GroupHistoryQuery & { cursor_string?: string }) {
    this.xhr?.abort();
    this.loading = query.cursor_string == null ? 'new' : 'more';

    this.xhr = $.ajax(
      route('group-history.index'),
      {
        data: query,
        dataType: 'JSON',
        method: 'GET',
      },
    );
    this.xhr
      .done(action((response: GroupHistoryJson) => {
        this.cursorString = response.cursor_string;
        groupStore.updateMany(response.groups);

        if (query.cursor_string == null) {
          this.currentQuery = { ...query };
          this.events = response.events;
          setUrlFromQuery(query);
        } else {
          this.events.push(...response.events);
        }
      }))
      .fail(onErrorWithCallback(() => this.loadEvents(query)))
      .always(action(() => this.loading = undefined));
  }

  private readonly onSearch = () => this.loadEvents(this.newQuery);

  private readonly onShowMore = () => {
    if (this.cursorString != null) {
      this.loadEvents({
        ...this.currentQuery,
        cursor_string: this.cursorString,
      });
    }
  };
}
