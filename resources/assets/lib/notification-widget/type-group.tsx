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
import * as React from 'react';
import { Spinner } from 'spinner';
import ItemGroup from './item-group';
import ItemOne from './item-one';
import Worker from './worker';

interface Props {
  items: Notification[];
  worker: Worker;
}

interface State {
  markingAsRead: boolean;
}

const bn = 'notification-type-group';

@observer
export default class TypeGroup extends React.Component<Props, State> {

  state = {
    markingAsRead: false,
  };
  private isComponentMounted = false;

  componentDidMount() {
    this.isComponentMounted = true;
  }

  componentWillUnmount() {
    this.isComponentMounted = false;
  }

  render() {
    if (this.props.items.length === 0) {
      return null;
    }

    const item = this.props.items[0];

    return (
      <div className={bn}>
        <div className={`${bn}__header`}>
          <div className={`${bn}__type`}>
            {osu.trans(`notifications.item.${item.objectType}._`)}

            {this.renderNotificationCount()}
          </div>

          {this.renderMarkAllReadButton()}
        </div>
        <div className={`${bn}__items`}>
          {this.renderItems()}
        </div>
      </div>
    );
  }

  private markRead = () => {
    this.setState({ markingAsRead: true });
    const ids = this.props.items.map((i) => i.id);

    this.props.worker.sendMarkRead(ids)
    .fail(() => {
      if (!this.isComponentMounted) {
        return;
      }

      this.setState({ markingAsRead: false });
    });
  }

  private renderItems() {
    const categoryGroup: Map<string, Notification[]> = new Map();

    this.props.items.forEach((item) => {
      if (item.objectId == null || item.name == null) {
        return;
      }

      const key = `${item.objectId}:${item.category}`;
      let groupedItems = categoryGroup.get(key);

      if (groupedItems == null) {
        groupedItems = [];
        categoryGroup.set(key, groupedItems);
      }

      groupedItems.push(item);
    });

    const items: React.ReactNode[] = [];

    categoryGroup.forEach((value, key) => {
      if (value.length === 0) {
        return;
      }

      let item: React.ReactNode;

      if (value.length === 1) {
        item = <ItemOne item={value[0]} worker={this.props.worker} />;
      } else if (value.length > 1) {
        item = <ItemGroup items={value} worker={this.props.worker} />;
      }

      items.push(
        <div className={`${bn}__item`} key={key}>{item}</div>,
      );
    });

    return items;
  }

  private renderMarkAllReadButton() {
    if (this.props.items[0].id < 0) {
      return null;
    }

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
        onClick={this.markRead}
      >
        {markingAsReadSpinner}
        {osu.trans('notifications.mark_all_read')}
      </button>
    );
  }

  private renderNotificationCount() {
    if (this.props.items.length === 1 && this.props.items[0] instanceof LegacyPmNotification) {
      return null;
    }

    return (
      <span className={`${bn}__count`}>
        {osu.formatNumber(this.props.items.length)}
      </span>
    );
  }
}
