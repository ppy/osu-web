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

import HeaderV3 from 'header-v3';
import { NotificationGroupJson } from 'interfaces/notification-bundle-json';
import { route } from 'laroute';
import { action, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import NotificationGroup from 'models/notification-group';
import TypeGroup from 'notification-widget/type-group';
import core from 'osu-core-singleton';
import * as React from 'react';
import { ShowMoreLink } from 'show-more-link';

interface State {
  group: null | 'beatmapset' | 'build' | 'channel' | 'forum_topic' | 'news_post' | 'user';
  loadingMore: boolean;
}

@observer
export class Main extends React.Component<{}, State> {
  static readonly links = [
    { title: 'All', url: route('notifications.index'), active: true },
    { title: 'Profile', url: route('notifications.index', { group: 'user' }) },
    { title: 'Beatmaps', url: route('notifications.index', { group: 'beatmapset' }) },
    { title: 'Forum', url: route('notifications.index', { group: 'forum_topic' }) },
    { title: 'News', url: route('notifications.index', { group: 'news_post' }) },
    { title: 'Build', url: route('notifications.index', { group: 'build' }) },
    { title: 'Chat', url: route('notifications.index', { group: 'channel' }) },
  ];

  readonly state = {
    group: this.groupFromUrl,
    loadingMore: false,
  };

  render() {
    return (
      <div className='osu-layout osu-layout--full'>
        <HeaderV3
          links={Main.links}
          theme='users'
          titleTrans={{
            info: 'History',
            key: 'Notifications',
          }}
        />

        <div className='osu-page osu-page--users'>
          {this.renderTypeGroups()}
        </div>
      </div>
    );
  }

  renderShowMoreButton(group: NotificationGroup) {
    if (this.state.group == null) { return null; }

    return (
      <div className='notification-popup__show-more'>
        <ShowMoreLink
          callback={this.loadMore}
          hasMore={group.cursor != null && group.total > group.notifications.size}
          loading={this.state.loadingMore}
          modifiers={['t-greysky']}
        />
      </div>
    );
  }

  renderTypeGroup(group: NotificationGroup, key: string) {
    if (group.total === 0) {
      return;
    }

    const notification = group.notifications.values().next().value;
    if (notification == null) {
      return;
    }

    return (
      <React.Fragment key={key}>
        <div className='notification-popup__item'>
          <TypeGroup
            item={notification}
            items={[...group.notifications.values()]}
          />
        </div>
        {this.renderShowMoreButton(group)}
      </React.Fragment>
    );
  }

  renderTypeGroups() {
    const nodes: React.ReactNode[] = [];
    const params = new URLSearchParams(location.search);

    for (const [key, group] of core.dataStore.notificationStore.groups) {
      if (params.has('group') && params.get('group') !== key) {
        continue;
      }

      nodes.push(this.renderTypeGroup(group, key));
    }

    return nodes;
  }

  @action
  loadMore = () => {
    if (this.state.group == null) { return; }
    const cursor = core.dataStore.notificationStore.groups.get(this.state.group)?.cursor;

    if (cursor == null) { return; }
    const data = { cursor, group: this.state.group };

    $.ajax({ url: route('notifications.index'), dataType: 'json', data })
    .then((response: NotificationGroupJson[]) => {
      runInAction(() => {
        response.forEach((json) => core.dataStore.notificationStore.updateWithGroupJson(json));
      });
    });
  }

  private getAllowedQueryStringValue<T>(allowed: T[], value: unknown) {
    const casted = value as T;
    if (allowed.indexOf(casted) > -1) {
      return casted;
    }

    return allowed[0];
  }

  private get groupFromUrl() {
    const url = new URL(location.href);

    return this.getAllowedQueryStringValue([null, 'beatmapset', 'build', 'channel', 'forum_topic', 'news_post', 'user'], url.searchParams.get('group'));
  }
}
