/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import { observer } from 'mobx-react';
import Notification from 'models/notification';
import { categoryToIcons } from 'notification-maps/icons';
import { messageGroup } from 'notification-maps/message';
import { urlGroup } from 'notification-maps/url';
import * as React from 'react';
import Item from './item';
import ItemCompact from './item-compact';
import ItemProps from './item-props';
import { withMarkRead, WithMarkReadProps } from './with-mark-read';

interface State {
  expanded: boolean;
}

export default withMarkRead(observer(class ItemGroup extends React.Component<ItemProps & WithMarkReadProps, State> {
  state = {
    expanded: false,
  };

  render() {
    return (
      <div className='notification-popup-item-group'>
        <Item
          canMarkRead={this.props.canMarkRead}
          markRead={this.props.markRead}
          markReadFallback={this.props.markReadFallback}
          markingAsRead={this.props.markingAsRead}

          expandButton={this.renderExpandButton()}
          icons={categoryToIcons[this.props.item.category || '']}
          item={this.props.item}
          message={messageGroup(this.props.item)}
          modifiers={['group']}
          url={urlGroup(this.props.item)}
          withCategory={true}
          withCoverImage={true}
        />
        {this.renderItems()}
      </div>
    );
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
            {osu.transChoice('common.count.update', this.props.items.length)}
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
        <ItemCompact item={item} items={[item]} worker={this.props.worker} />
      </div>
    );
  }

  private renderItems() {
    if (!this.state.expanded) {
      return null;
    }

    return <div className='notification-popup-item-group__items'>{this.props.items.map(this.renderItem)}</div>;
  }

  private toggleExpand = () => {
    this.setState({ expanded: !this.state.expanded });
  }
}));
