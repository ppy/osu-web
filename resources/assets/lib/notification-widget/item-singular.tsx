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
import { nameToIcons } from 'notification-maps/icons';
import { messageSingular } from 'notification-maps/message';
import { urlSingular } from 'notification-maps/url';
import * as React from 'react';
import Item from './item';
import ItemProps from './item-props';
import { withMarkRead, WithMarkReadProps } from './with-mark-read';

export default withMarkRead(observer(class ItemSingular extends React.Component<ItemProps & WithMarkReadProps> {
  render() {
    return (
      <Item
        canMarkRead={this.props.canMarkRead}
        markRead={this.props.markRead}
        markReadFallback={this.props.markReadFallback}
        markingAsRead={this.props.markingAsRead}

        icons={nameToIcons[this.props.item.name || '']}
        item={this.props.item}
        message={messageSingular(this.props.item)}
        modifiers={['one']}
        url={urlSingular(this.props.item)}
        withCategory={true}
        withCoverImage={true}
      />
    );
  }
}));
