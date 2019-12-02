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

import { NotificationBundleJson } from 'interfaces/notification-json';
import { action, observable } from 'mobx';
import {
  NotificationEventNewJson,
  NotificationEventReadJson,
  NotificationEventStackRead,
  NotificationEventTypeRead,
} from 'notifications/notification-events';
import NotificationStackStore from './notification-stack-store';

export default class UnreadNotificationStackStore extends NotificationStackStore {
  @observable total = 0;

  @action
  handleNotificationEventNew(event: NotificationEventNewJson) {
    this.total++;
  }

  @action
  handleNotificationEventRead(event: NotificationEventReadJson) {
    this.markAsRead(event.data.ids);
  }

  @action
  handleNotificationEventStackRead(event: NotificationEventStackRead) {
    const { category, object_id, object_type } = event.data;
    const id = `${object_type}-${object_id}-${category}`;
    const stack = this.stacks.get(id);
    if (stack == null) return;

    stack.notifications.forEach((notification) => notification.isRead = true);
    this.stacks.delete(id);
    this.total -= stack.total;

    const type = this.types.get(stack.type);
    if (type == null) return;
    type.removeStack(stack);
  }

  @action
  handleNotificationEventTypeRead(event: NotificationEventTypeRead) {
    const type = this.types.get(event.data.name);
    if (type == null) return;

    type.stacks.forEach((stack) => stack.notifications.forEach((notification) => notification.isRead = true));
    this.types.delete(event.data.name);
    this.total -= type.total;
  }

  @action
  updateWithBundle(bundle: NotificationBundleJson) {
    super.updateWithBundle(bundle);

    if (bundle.unread_count != null) {
      this.total = bundle.unread_count;
    }
  }

  @action
  private markAsRead(ids: number[]) {
    for (const id of ids) {
      const notification = this.notifications.get(id);
      if (notification == null || notification.isRead) continue;

      notification.isRead = true;
      this.total--;

      const stack = this.stacks.get(notification.stackId);
      if (stack == null) continue;

      stack.remove(notification);

      const type = this.types.get(stack.type);
      if (type == null) continue;
      type.total--;
    }
  }
}
