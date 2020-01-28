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
import { categoryToIcons } from 'notification-maps/icons';
import { urlGroup } from 'notification-maps/url';
import { NotificationContext } from 'notifications-context';
import * as React from 'react';
import { ShowMoreLink } from 'show-more-link';
import { Spinner } from 'spinner';
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
  readonly state = {
    expanded: false,
  };

  render() {
    const item = this.props.stack.first;
    if (item == null) { return null; }

    return (
      <div className='notification-popup-item-group'>
        <Item
          canMarkAsRead={this.props.stack.canMarkAsRead}
          markRead={this.handleMarkAsRead}
          markingAsRead={this.props.stack.isMarkingAsRead}
          expandButton={this.renderExpandButton()}
          icons={categoryToIcons[item.category]}
          item={item}
          message={item.messageGroup}
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
    this.props.stack.markStackAsRead();
  }

  private handleShowLess = () => {
    this.setState({ expanded: false });
  }

  private handleShowMore = () => {
    this.props.stack.loadMore(this.context);
  }

  private renderExpandButton() {
    const count = this.props.stack.total;
    const transKey = this.context.isWidget ? 'common.count.update' : 'common.count.notifications';

    return (
      <button
        type='button'
        className='show-more-link show-more-link--notification-group'
        onClick={this.toggleExpand}
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

  private renderItem = (item: Notification) => {
    return (
      <div className='notification-popup-item-group__item' key={item.id}>
        <ItemCompact item={item} stack={this.props.stack} />
      </div>
    );
  }

  private renderItems() {
    if (!this.state.expanded) {
      return null;
    }

    return (
      <div className='notification-popup-item-group__items'>
        {this.props.stack.orderedNotifications.map(this.renderItem)}
        <div className='notification-popup__show-more'>
          <div className='notification-popup__expand'>
            {this.renderShowMore()}
          </div>
          <div className='notification-popup__collapse'>
            {this.renderShowLess()}
            <div className='notification-popup__mark-as-read'>
              {this.renderMarkAsReadButton()}
            </div>
          </div>
        </div>

      </div>
    );
  }

  private renderMarkAsReadButton() {
    if (this.props.stack.isMarkingAsRead) {
      return (
        <div className='notification-popup-item__read-button'>
          <Spinner />
        </div>
      );
    } else {
      return (
        <button
          type='button'
          className='notification-popup-item__read-button'
          onClick={this.handleMarkAsRead}
        >
          <span className='fas fa-times' />
        </button>
      );
    }
  }

  private renderShowLess() {
    return (
      <ShowMoreLink
        callback={this.handleShowLess}
        direction='up'
        hasMore={true}
        label={osu.trans('common.buttons.show_less')}
        modifiers={['notification-group']}
      />
    );
  }

  private renderShowMore() {
    const stack = this.props.stack;
    if (!stack.hasMore) { return null; }

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
  }
}
