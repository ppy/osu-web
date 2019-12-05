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
import { computed } from 'mobx';
import { observer } from 'mobx-react';
import { getValidName, Name as NotificationTypeName } from 'models/notification-type';
import Stack from 'notification-widget/stack';
import core from 'osu-core-singleton';
import * as React from 'react';

interface State {
  loadingMore: boolean;
  type: NotificationTypeName;
}

@observer
export class Main extends React.Component<{}, State> {
  readonly links = [
    { title: 'All', url: route('notifications.index'), type: null },
    { title: 'Profile', url: route('notifications.index', { type: 'user' }), type: 'user' },
    { title: 'Beatmaps', url: route('notifications.index', { type: 'beatmapset' }), type: 'beatmapset' },
    { title: 'Forum', url: route('notifications.index', { type: 'forum_topic' }), type: 'forum_topic' },
    { title: 'News', url: route('notifications.index', { type: 'news_post' }), type: 'news_post' },
    { title: 'Build', url: route('notifications.index', { type: 'build' }), type: 'build' },
    { title: 'Chat', url: route('notifications.index', { type: 'channel' }), type: 'channel' },
  ];

  readonly state = {
    loadingMore: false,
    type: this.typeNameFromUrl,
  };

  private readonly store = core.dataStore.notificationStore.stacks;

  @computed
  private get typeNameFromUrl() {
    const url = new URL(location.href);

    return getValidName(url.searchParams.get('type'));
  }

  render() {
    return (
      <div className='osu-layout osu-layout--full'>
        <HeaderV4
          links={this.links}
          onLinkClick={this.handleLinkClick}
          section='Notifications'
          subSection='History'
          theme='notifications'
        />

        <div className='osu-page osu-page--generic-compact'>
          <div className='notification-index'>
            <div className='notification-popup__item'>
              <div className='notification-type-group__items'>
                {this.renderStacks()}
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }

  renderStacks() {
    const nodes: React.ReactNode[] = [];
    for (const stack of this.store.stacksOfType(this.state.type)) {
      nodes.push(<Stack key={stack.id} stack={stack} />);
    }

    return nodes;
  }

  private handleLinkClick = (event: React.MouseEvent<HTMLAnchorElement>) => {
    const type = (event.target as HTMLAnchorElement).dataset.type as NotificationTypeName;
    this.setState({ type });
    event.preventDefault();
  }
}
