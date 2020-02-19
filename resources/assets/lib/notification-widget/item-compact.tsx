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
        markRead={this.handleMarkAsRead}
        icons={nameToIconsCompact[this.props.item.name || '']}
        item={this.props.item}
        message={formatMessage(this.props.item, true)}
        modifiers={['compact']}
        url={urlSingular(this.props.item)}
        withCategory={false}
        withCoverImage={false}
      />
    );
  }

  private handleMarkAsRead = () => {
    this.props.stack.markAsRead(this.props.item);
  }
}
