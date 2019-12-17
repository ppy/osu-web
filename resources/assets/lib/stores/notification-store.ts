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
import { action, observable } from 'mobx';
import LegacyPmNotification from 'models/legacy-pm-notification';
import Notification from 'models/notification';
import { NotificationEventNewJson } from 'notifications/notification-events';
import NotificationStackStore from './notification-stack-store';
import UnreadNotificationStackStore from './unread-notification-stack-store';

export default class NotificationStore {
  @observable notifications = new Map<number, Notification>();
  @observable pmNotification = new LegacyPmNotification();
  readonly stacks = new NotificationStackStore(this);
  readonly unreadStacks = new UnreadNotificationStackStore(this);

  @action
  flushStore() {
    this.notifications.clear();
  }

  add(notification: Notification) {
    this.notifications.set(notification.id, notification);
  }

  get(id: number) {
    return this.notifications.get(id);
  }

  @action
  handleNotificationEventNew(event: NotificationEventNewJson) {
    this.updateWithJson(event.data);
  }

  private updateWithJson(json: NotificationJson) {
    // TODO: push out updates to all the stacks as well?
    let notification = this.notifications.get(json.id);

    if (notification == null) {
      notification = Notification.fromJson(json);
      this.notifications.set(notification.id, notification);
    } else {
      return notification.updateFromJson(json);
    }

    return notification;
  }
}
