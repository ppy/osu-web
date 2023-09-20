// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import Notification from 'models/notification';
import NotificationStack from 'models/notification-stack';
import { nameToIconsCompact } from 'notification-maps/icons';
import { formatMessage } from 'notification-maps/message';
import { urlSingular } from 'notification-maps/url';
import * as React from 'react';
import Item from './item';

interface Props {
  item: Notification;
  stack: NotificationStack;
}

@observer
export default class ItemCompact extends React.Component<Props> {
  render() {
    return (
      <Item
        delete={this.handleDelete}
        icons={nameToIconsCompact[this.props.item.name || '']}
        item={this.props.item}
        markRead={this.handleMarkAsRead}
        message={formatMessage(this.props.item, true)}
        modifiers={['compact']}
        url={urlSingular(this.props.item)}
        withCategory={false}
        withCoverImage={this.props.item.name === 'user_achievement_unlock' || this.props.item.category === 'user_beatmapset_new'}
      />
    );
  }

  private handleDelete = () => {
    this.props.stack.deleteItem(this.props.item);
  };

  private handleMarkAsRead = () => {
    this.props.stack.markAsRead(this.props.item);
  };
}
