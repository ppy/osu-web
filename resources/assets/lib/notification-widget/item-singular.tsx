// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import NotificationStack from 'models/notification-stack';
import { nameToIcons } from 'notification-maps/icons';
import { formatMessage } from 'notification-maps/message';
import { urlSingular } from 'notification-maps/url';
import * as React from 'react';
import Item from './item';

interface Props {
  stack: NotificationStack;
}

@observer
export default class ItemSingular extends React.Component<Props> {
  render() {
    const item = this.props.stack.first;
    if (item == null) { return null; }

    return (
      <Item
        markRead={this.handleMarkAsRead}
        markingAsRead={item.isMarkingAsRead}
        icons={nameToIcons[item.name || '']}
        item={item}
        message={formatMessage(item)}
        modifiers={['one']}
        url={urlSingular(item)}
        withCategory={true}
        withCoverImage={true}
      />
    );
  }

  private handleMarkAsRead = () => {
    this.props.stack.markAsRead(this.props.stack.first);
  }
}
