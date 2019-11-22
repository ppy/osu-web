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

import * as _ from 'lodash';
import { observer } from 'mobx-react';
import LegacyPmNotification from 'models/legacy-pm-notification';
import Notification from 'models/notification';
import NotificationType from 'models/notification-type';
import core from 'osu-core-singleton';
import * as React from 'react';
import { Spinner } from 'spinner';
import ItemGroup from './item-group';
import ItemProps from './item-props';
import ItemSingular from './item-singular';
import { WithMarkReadProps } from './with-mark-read';
import { ShowMoreLink } from 'show-more-link';
import { action, computed } from 'mobx';

interface Props {
  hasMore: boolean;
  showRead: boolean;
  type: NotificationType;
}

interface State {
  markingAsRead: boolean;
}

const bn = 'notification-type-group';

@observer
export default class TypeGroup extends React.Component<Props & WithMarkReadProps, State> {
  static defaultProps = {
    hasMore: true,
    showRead: false,
  };

  state = {
    markingAsRead: false,
  };

  @computed
  get count() {
    return this.props.showRead ? this.props.type.total : this.props.type.unreadCount;
  }

  render() {
    const type = this.props.type;
    if (this.count === 0 || type.stacks.size === 0) {
      return null;
    }

    return (
      <>
        <div className='notification-popup__item'>
          <div className={bn}>
            <div className={`${bn}__header`}>
              <div className={`${bn}__type`}>
                {osu.trans(`notifications.item.${this.props.type.name}._`)}

                {this.renderNotificationCount()}
              </div>

              {this.renderMarkAllReadButton()}
            </div>
            <div className={`${bn}__items`}>
              {this.renderStacks()}
            </div>
          </div>
        </div>
        {this.renderShowMore()}
      </>
    );
  }

  private handleMarkAllAsRead = () => {
    this.setState({ markingAsRead: true });
    // core.dataStore.notificationStore.markAsRead(this.props.items)
    // .always(() => {
    //   this.setState({ markingAsRead: false });
    // });
  }

  @action
  private handleShowMore = () => {
    this.props.type.loadMore();
  }

  private renderShowMore() {
    if (!this.props.hasMore) { return null; }
    const type = this.props.type;

    return (
      <div className='notification-popup__show-more'>
        <ShowMoreLink
          callback={this.handleShowMore}
          hasMore={type.cursor != null}
          loading={type.isLoading}
          modifiers={['t-greysky']}
        />
      </div>
    );
  }

  private renderStacks() {
    const nodes: React.ReactNode[] = [];

    this.props.type.stacks.forEach((stack) => {
      const item = stack.first;
      if (item == null) {
        return;
      }

      const Component = stack.isSingle ? ItemSingular : ItemGroup;
      const items = [...stack.notifications.values()];
      const params = {
        items,
        markingAsRead: this.state.markingAsRead,
      };

      if (stack.isSingle) {
        params['item'] = item;
      } else {
        params['stack'] = stack;
      }

      nodes.push((
        <div className={`${bn}__item`} key={stack.id}>
          <Component {...params} />
        </div>
      ));
    });

    return nodes;
  }

  private renderMarkAllReadButton() {
    // TODO: no button for legacy pm type group
    // if (this.props.items[0].id < 0) {
    //   return null;
    // }

    let markAllReadClass = `${bn}__clear-all`;
    let markingAsReadSpinner: React.ReactNode = null;

    if (this.state.markingAsRead) {
      markingAsReadSpinner = (
        <span className={`${bn}__clear-all-spinner`}>
          <Spinner />
        </span>
      );
      markAllReadClass += ` ${bn}__clear-all--disabled`;
    }

    return (
      <button
        className={markAllReadClass}
        type='button'
        onClick={this.handleMarkAllAsRead}
      >
        {markingAsReadSpinner}
        {osu.trans('notifications.mark_all_read')}
      </button>
    );
  }

  private renderNotificationCount() {
    // TODO: legacy pm type group
    // if (this.props.items.length === 1 && this.props.items[0] instanceof LegacyPmNotification) {
    //   return null;
    // }

    return (
      <span className={`${bn}__count`}>
        {osu.formatNumber(this.count)}
      </span>
    );
  }
}
