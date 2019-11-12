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

import NotificationJson from 'interfaces/notification-json';
import { route } from 'laroute';
import { debounce } from 'lodash';
import { action, observable, runInAction } from 'mobx';
import Notification from 'models/notification';
import Store from 'stores/store';

export default class NotificationStore extends Store {
  @observable notifications = new Map<number, Notification>();
  @observable unreadCount = 0;

  private debouncedSendQueued = debounce(this.sendQueued, 500);
  private queued = new Map<number, Notification>();
  private queuedXhr?: JQuery.jqXHR;

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
      if (!this.queued.has(notification.id)) {
        this.queued.set(notification.id, notification);
      }
    }

    this.debouncedSendQueued();
  }

  sendQueued() {
    const ids = [...this.queued.keys()];
    if (ids.length === 0) { return; }

    this.queuedXhr = $.ajax({
      data: { ids },
      dataType: 'json',
      method: 'POST',
      url: route('notifications.mark-read'),
    });

    this.queuedXhr.then(() => {
      runInAction(() => {
        this.updateMarkedAsRead(ids);
      });
    }).always(() => {
      runInAction(() => {
        for (const id of ids) {
          const notification = this.queued.get(id);
          if (notification) {
            notification.isMarkingAsRead = false;
            this.queued.delete(id);
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
  updateWithJson(json: NotificationJson) {
    let notification = this.notifications.get(json.id);

    if (notification == null) {
      notification = new Notification(json.id);
      this.notifications.set(notification.id, notification);
    }

    return notification.updateFromJson(json);
  }
}
