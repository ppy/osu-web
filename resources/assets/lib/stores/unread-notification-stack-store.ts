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

import { NotificationBundleJson } from 'interfaces/notification-bundle-json';
import Notification from 'models/notification';
import NotificationStack, { idFromJson } from 'models/notification-stack';
import NotificationType from 'models/notification-type';
import NotificationStackStore from './notification-stack-store';

export default class UnreadNotificationStackStore extends NotificationStackStore {
  unreadFilter(notification: Notification) {
    return !notification.isRead;
  }

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
        stack = new NotificationStack(json.object_id, json.object_type, json.name, this.unreadFilter);
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
}
