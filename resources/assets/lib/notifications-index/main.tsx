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

import HeaderV4 from 'header-v4';
import { route } from 'laroute';
import { observer } from 'mobx-react';
import NotificationType, { getValidName, Name as NotificationTypeName } from 'models/notification-type';
import TypeGroup from 'notification-widget/type-group';
import core from 'osu-core-singleton';
import * as React from 'react';

interface State {
  loadingMore: boolean;
  type: NotificationTypeName;
}

@observer
export class Main extends React.Component<{}, State> {
  static readonly links = [
    { title: 'All', url: route('notifications.index'), active: true },
    { title: 'Profile', url: route('notifications.index', { type: 'user' }) },
    { title: 'Beatmaps', url: route('notifications.index', { type: 'beatmapset' }) },
    { title: 'Forum', url: route('notifications.index', { type: 'forum_topic' }) },
    { title: 'News', url: route('notifications.index', { type: 'news_post' }) },
    { title: 'Build', url: route('notifications.index', { type: 'build' }) },
    { title: 'Chat', url: route('notifications.index', { type: 'channel' }) },
  ];

  readonly state = {
    loadingMore: false,
    type: this.typeNameFromUrl,
  };

  private readonly store = core.dataStore.notificationStore.stacks;

  render() {
    return (
      <div className='osu-layout osu-layout--full'>
        <HeaderV4
          links={Main.links}
          section='Notifications'
          subSection='History'
          theme='notifications'
        />

        <div className='osu-page osu-page--generic-compact'>
          <div className='notification-index'>
            {this.renderTypes()}
          </div>
        </div>
      </div>
    );
  }

  renderType(type: NotificationType) {
    return <TypeGroup key={type.name} type={type} canShowMore={this.state.type != null} />;
  }

  renderTypes() {
    const nodes: React.ReactNode[] = [];
    const params = new URLSearchParams(location.search);

    for (const [, type] of this.store.types) {
      if (params.has('type') && params.get('type') !== type.name) {
        continue;
      }

      nodes.push(this.renderType(type));
    }

    return nodes;
  }

  private get typeNameFromUrl() {
    const url = new URL(location.href);

    return getValidName(url.searchParams.get('type'));
  }
}
