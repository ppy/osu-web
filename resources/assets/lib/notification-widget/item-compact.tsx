/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import { observer } from 'mobx-react';
import { nameToIconsCompact } from 'notification-maps/icons';
import { formatMessage } from 'notification-maps/message';
import { urlSingular } from 'notification-maps/url';
import * as React from 'react';
import Item from './item';
import ItemProps from './item-props';
import { withMarkRead, WithMarkReadProps } from './with-mark-read';

export default withMarkRead(observer(class ItemCompact extends React.Component<ItemProps & WithMarkReadProps> {
  render() {
    return (
      <Item
        canMarkRead={this.props.canMarkRead}
        markRead={this.props.markRead}
        markReadFallback={this.props.markReadFallback}
        markingAsRead={this.props.markingAsRead}

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
}));
