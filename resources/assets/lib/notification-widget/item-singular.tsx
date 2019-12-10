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
