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

import { NotificationBundleJson, NotificationTypeJson } from 'interfaces/notification-bundle-json';
import NotificationJson from 'interfaces/notification-json';
import { route } from 'laroute';
import { debounce, orderBy } from 'lodash';
import { action, computed, observable, runInAction } from 'mobx';
import LegacyPmNotification from 'models/legacy-pm-notification';
import Notification from 'models/notification';
import NotificationStack, { idFromJson } from 'models/notification-stack';
import NotificationType from 'models/notification-type';
import Store from 'stores/store';

export default class NotificationStore extends Store {
  cursor: JSON | null = null;
  @observable notifications = new Map<number, Notification>();
  @observable pmNotification = new LegacyPmNotification();
  @observable stacks = new Map<string, NotificationStack>();
  @observable types = new Map<string, NotificationType>();
  @observable unreadCount = 0;

  private debouncedSendQueued = debounce(this.sendQueued, 500);
  private queued = new Set<number>();
  private queuedXhr?: JQuery.jqXHR;

  @computed
  get itemsGroupedByType() {
    const ret: Map<string, Notification[]> = new Map();

    const sortedItems = orderBy([...this.notifications.values()], ['id'], ['desc']);
    sortedItems.unshift(this.pmNotification);

    sortedItems.forEach((item) => {
      const key = item.displayType;

      if (key == null) {
        return;
      }

      let groupedItems = ret.get(key);

      if (groupedItems == null) {
        groupedItems = [];
        ret.set(key, groupedItems);
      }

      groupedItems.push(item);
    });

    return ret;
  }

  @action
  flushStore() {
    this.notifications.clear();
  }

  get(id: number) {
    this.notifications.get(id);
  }

  @action
  markAsRead(notifications: Notification[]) {
    notifications.forEach((notification) => this.queueMarkAsRead(notification));

    this.debouncedSendQueued.flush();

    return this.queuedXhr!;
  }

  @action
  queueMarkAsRead(notification: Notification) {
    if (notification.canMarkRead) {
      notification.isMarkingAsRead = true;
      this.queued.add(notification.id);
    }

    this.debouncedSendQueued();
  }

  sendQueued() {
    const ids = [...this.queued];
    if (ids.length === 0) { return; }

    this.queuedXhr = $.ajax({
      data: { ids },
      dataType: 'json',
      method: 'POST',
      url: route('notifications.mark-read'),
    });

    ids.forEach((id) => this.queued.delete(id));

    this.queuedXhr.then(() => {
      runInAction(() => {
        this.updateMarkedAsRead(ids);
      });
    }).always(() => {
      runInAction(() => {
        for (const id of ids) {
          const notification = this.notifications.get(id);
          if (notification != null) {
            notification.isMarkingAsRead = false;
          }
        }
      });
    });

    return this.queuedXhr;
  }

  @action
  updateMarkedAsRead(ids: number[]) {
    for (const id of ids) {
      const item = this.notifications.get(id);

      if (item == null || !item.isRead) {
        this.unreadCount--;
      }

      if (item != null) {
        item.isRead = true;
      }
    }
  }

  @action
  updateWithBundle(bundle: NotificationBundleJson) {
    bundle.types?.forEach((json) => {
      let type = this.types.get(json.name);
      if (type == null) {
        type = new NotificationType(json.name);
        this.types.set(type.name, type);
      }
      type.updateWithJson(json);
    });

    bundle.stacks?.forEach((json) => {
      let stack = this.stacks.get(idFromJson(json));
      if (stack == null) {
        stack = new NotificationStack(json.object_id, json.object_type, json.name);
        this.stacks.set(stack.id, stack);
      }
      stack.updateWithJson(json);
      this.types.get(stack.objectType)?.stacks.set(stack.id, stack);
    });

    bundle.notifications?.forEach((json) => {
      let notification = this.notifications.get(json.id);
      if (notification == null) {
        notification = new Notification(json.id);
        this.notifications.set(notification.id, notification);
      }
      notification.updateFromJson(json);
      this.stacks.get(notification.stackId)?.notifications.set(notification.id, notification);
    });
  }

  @action
  updateWithGroupJson(json: NotificationTypeJson) {
    let group = this.types.get(json.name);

    if (group == null) {
      group = new NotificationType(json.name);
      this.types.set(json.name, group);
    }

    // group.appendWithJson(json);

    // json.notificationGroups.forEach((group) => this.updateWithJson(item));
  }

  @action
  updateWithJson(json: NotificationJson) {
    let notification = this.notifications.get(json.id);

    if (notification == null) {
      notification = new Notification(json.id);
      this.notifications.set(notification.id, notification);
    }

    return notification.updateFromJson(json);
  }
}
