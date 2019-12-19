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
import { Name as NotificationTypeName } from 'models/notification-type';
import Stack from 'notification-widget/stack';
import { NotificationContext } from 'notifications-context';
import NotificationController from 'notifications/notification-controller';
import core from 'osu-core-singleton';
import * as React from 'react';
import { ShowMoreLink } from 'show-more-link';

@observer
export class Main extends React.Component {
  static readonly contextType = NotificationContext;

  readonly links = [
    { title: 'All', url: route('notifications.index'), data: { 'data-type': null }},
    { title: 'Profile', url: route('notifications.index', { type: 'user' }), data: { 'data-type': 'user' }},
    { title: 'Beatmaps', url: route('notifications.index', { type: 'beatmapset' }), data: { 'data-type': 'beatmapset' }},
    { title: 'Forum', url: route('notifications.index', { type: 'forum_topic' }), data: { 'data-type': 'forum_topic' }},
    { title: 'News', url: route('notifications.index', { type: 'news_post' }), data: { 'data-type': 'news_post' }},
    { title: 'Build', url: route('notifications.index', { type: 'build' }), data: { 'data-type': 'build' }},
    { title: 'Chat', url: route('notifications.index', { type: 'channel' }), data: { 'data-type': 'channel' }},
  ];

  private readonly controller = new NotificationController(core.dataStore.notificationStore, this.context);

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
                {this.renderShowMore()}
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }

  renderShowMore() {
    const type = this.controller.type;

    return (
      <ShowMoreLink
        callback={this.handleShowMore}
        hasMore={type?.hasMore}
        loading={type?.isLoading}
        modifiers={['notification-group']}
      />
    );
  }

  renderStacks() {
    const nodes: React.ReactNode[] = [];
    for (const stack of this.controller.stacks) {
      nodes.push(<Stack key={stack.id} stack={stack} />);
    }

    return nodes;
  }

  private handleLinkClick = (event: React.MouseEvent<HTMLAnchorElement>) => {
    event.preventDefault();

    const type = ((event.target as HTMLAnchorElement).dataset.type ?? null) as NotificationTypeName;
    this.controller.navigateTo(type);
  }

  private handleShowMore = () => {
    this.controller.type?.loadMore(this.context);
  }
}
