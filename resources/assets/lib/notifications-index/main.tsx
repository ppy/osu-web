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
import { NotificationTypeJson } from 'interfaces/notification-bundle-json';
import { route } from 'laroute';
import { action, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import NotificationType, { getValidName, Name as NotificationTypeName } from 'models/notification-type';
import TypeGroup from 'notification-widget/type-group';
import core from 'osu-core-singleton';
import * as React from 'react';
import { ShowMoreLink } from 'show-more-link';

interface State {
  loadingMore: boolean;
  type: NotificationTypeName;
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
    loadingMore: false,
    type: this.typeNameFromUrl,
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
          {this.renderTypes()}
        </div>
      </div>
    );
  }

  renderShowMoreButton(type: NotificationType) {
    if (this.state.type == null) { return null; }

    return (
      <div className='notification-popup__show-more'>
        <ShowMoreLink
          callback={this.loadMore}
          hasMore={type.cursor != null}
          loading={this.state.loadingMore}
          modifiers={['t-greysky']}
        />
      </div>
    );
  }

  renderType(type: NotificationType) {
    if (type.total === 0 || type.stacks.size === 0) {
      return;
    }

    return (
      <React.Fragment key={type.name}>
        <div className='notification-popup__item'>
          <TypeGroup
            showRead={true}
            type={type}
          />
        </div>
        {this.renderShowMoreButton(type)}
      </React.Fragment>
    );
  }

  renderTypes() {
    const nodes: React.ReactNode[] = [];
    const params = new URLSearchParams(location.search);

    for (const [, type] of core.dataStore.notificationStore.types) {
      if (params.has('group') && params.get('group') !== type.name) {
        continue;
      }

      nodes.push(this.renderType(type));
    }

    return nodes;
  }

  @action
  loadMore = () => {
    if (this.state.type == null) { return; }
    const cursor = core.dataStore.notificationStore.types.get(this.state.type)?.cursor;

    if (cursor == null) { return; }
    const data = { cursor, group: this.state.type };

    $.ajax({ url: route('notifications.index'), dataType: 'json', data })
    .then((response: NotificationTypeJson[]) => {
      runInAction(() => {
        response.forEach((json) => core.dataStore.notificationStore.updateWithGroupJson(json));
      });
    });
  }

  private get typeNameFromUrl() {
    const url = new URL(location.href);

    return getValidName(url.searchParams.get('group'));
  }
}
