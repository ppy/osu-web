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

import { observer } from 'mobx-react';
import Notification from 'models/notification';
import { categoryToIcons } from 'notification-maps/icons';
import { messageGroup } from 'notification-maps/message';
import { urlGroup } from 'notification-maps/url';
import core from 'osu-core-singleton';
import * as React from 'react';
import Item from './item';
import ItemCompact from './item-compact';
import ItemProps from './item-props';
import { WithMarkReadProps } from './with-mark-read';
import NotificationStack from 'models/notification-stack';

interface Props {
  stack: NotificationStack;
}

interface State {
  expanded: boolean;
  markingAsRead: boolean;
}

@observer
export default class ItemGroup extends React.Component<Props & WithMarkReadProps, State> {
  state = {
    expanded: false,
    markingAsRead: false,
  };

  render() {
    const item = this.props.stack.first!;
    return (
      <div className='notification-popup-item-group'>
        <Item
          markRead={this.handleMarkAsRead}
          markingAsRead={this.props.markingAsRead || this.state.markingAsRead}
          expandButton={this.renderExpandButton()}
          icons={categoryToIcons[item.category || '']}
          item={item}
          message={messageGroup(item)}
          modifiers={['group']}
          url={urlGroup(item)}
          withCategory={true}
          withCoverImage={true}
        />
        {this.renderItems()}
      </div>
    );
  }

  private handleMarkAsRead = () => {
    this.setState({ markingAsRead: true });
    // core.dataStore.notificationStore.markAsRead(this.props.items)
    // .always(() => {
    //   this.setState({ markingAsRead: false });
    // });
  }

  private renderExpandButton() {
    return (
      <button
        type='button'
        className='show-more-link show-more-link--notification-group show-more-link--t-greysky'
        onClick={this.toggleExpand}
      >
        <span className='show-more-link__label'>
          <span className='show-more-link__label-text'>
            {osu.transChoice('common.count.update', this.props.stack.total)}
          </span>
          <span className='show-more-link__label-icon'>
            <span className={`fas fa-angle-${this.state.expanded ? 'up' : 'down'}`} />
          </span>
        </span>
      </button>
    );
  }

  private renderItem = (item: Notification) => {
    return (
      <div className='notification-popup-item-group__item' key={item.id}>
        <ItemCompact item={item} items={[item]} />
      </div>
    );
  }

  private renderItems() {
    if (!this.state.expanded) {
      return null;
    }

    const notifications = [...this.props.stack.notifications.values()];

    return <div className='notification-popup-item-group__items'>{notifications.map(this.renderItem)}</div>;
  }

  private toggleExpand = () => {
    this.setState({ expanded: !this.state.expanded });
  }
}
