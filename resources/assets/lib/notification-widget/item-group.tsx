// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import Notification from 'models/notification';
import NotificationStack from 'models/notification-stack';
import { categoryToIcons } from 'notification-maps/icons';
import { formatMessageGroup } from 'notification-maps/message';
import { urlGroup } from 'notification-maps/url';
import { NotificationContext } from 'notifications-context';
import NotificationDeleteButton from 'notifications/notification-delete-button';
import NotificationReadButton from 'notifications/notification-read-button';
import * as osu from 'osu-common';
import * as React from 'react';
import ShowMoreLink from 'show-more-link';
import Item from './item';
import ItemCompact from './item-compact';

interface Props {
  stack: NotificationStack;
}

interface State {
  expanded: boolean;
}

@observer
export default class ItemGroup extends React.Component<Props, State> {
  static readonly contextType = NotificationContext;
  declare context: React.ContextType<typeof NotificationContext>;
  readonly state = {
    expanded: false,
  };

  render() {
    const item = this.props.stack.first;
    if (item == null) {
      return null;
    }

    return (
      <div className='notification-popup-item-group'>
        <Item
          canMarkAsRead={this.props.stack.canMarkAsRead}
          delete={this.handleDelete}
          expandButton={this.renderExpandButton()}
          icons={categoryToIcons[item.category]}
          isDeleting={this.props.stack.isDeleting}
          isMarkingAsRead={this.props.stack.isMarkingAsRead}
          item={item}
          markRead={this.handleMarkAsRead}
          message={formatMessageGroup(item)}
          modifiers={['group']}
          url={urlGroup(item)}
          withCategory
          withCoverImage
        />
        {this.renderItems()}
      </div>
    );
  }

  private handleDelete = () => {
    this.props.stack.delete();
  };

  private handleMarkAsRead = () => {
    this.props.stack.markStackAsRead();
  };

  private handleShowLess = () => {
    this.setState({ expanded: false });
  };

  private handleShowMore = () => {
    this.props.stack.loadMore(this.context);
  };

  private renderExpandButton() {
    const count = this.props.stack.total;
    const transKey = this.context.isWidget ? 'common.count.update' : 'common.count.notifications';

    return (
      <button
        className='show-more-link show-more-link--notification-group'
        onClick={this.toggleExpand}
        type='button'
      >
        <span className='show-more-link__label'>
          <span className='show-more-link__label-text'>
            {osu.transChoice(transKey, count)}
          </span>
          <span className='show-more-link__label-icon'>
            <span className={`fas fa-angle-${this.state.expanded ? 'up' : 'down'}`} />
          </span>
        </span>
      </button>
    );
  }

  private renderItem = (item: Notification) => (
    <div key={item.id} className='notification-popup-item-group__item'>
      <ItemCompact item={item} stack={this.props.stack} />
    </div>
  );

  private renderItems() {
    if (!this.state.expanded) {
      return null;
    }

    return (
      <div className='notification-popup-item-group__items'>
        {this.props.stack.orderedNotifications.map(this.renderItem)}
        <div className='notification-popup-item-group__show-more'>
          <div className='notification-popup-item-group__expand'>
            {this.renderShowMore()}
          </div>
          <div className='notification-popup-item-group__collapse'>
            {this.renderShowLess()}
            {this.props.stack.canMarkAsRead && (
              <NotificationReadButton
                isMarkingAsRead={this.props.stack.isMarkingAsRead}
                onMarkAsRead={this.handleMarkAsRead}
              />
            )}
            {!this.context.isWidget && (
              <NotificationDeleteButton
                isDeleting={this.props.stack.isDeleting}
                onDelete={this.handleDelete}
              />
            )}
          </div>
        </div>
      </div>
    );
  }

  private renderShowLess() {
    return (
      <ShowMoreLink
        callback={this.handleShowLess}
        direction='up'
        hasMore
        label={osu.trans('common.buttons.show_less')}
        modifiers={['notification-group']}
      />
    );
  }

  private renderShowMore() {
    const stack = this.props.stack;
    if (!stack.hasMore) {
      return null;
    }

    return (
      <ShowMoreLink
        callback={this.handleShowMore}
        hasMore={stack.cursor != null}
        loading={stack.isLoading}
        modifiers={['notification-group']}
      />
    );
  }

  private toggleExpand = () => {
    this.setState({ expanded: !this.state.expanded });
  };
}
