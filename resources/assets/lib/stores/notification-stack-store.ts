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

import NotificationJson, { NotificationBundleJson, NotificationStackJson, NotificationTypeJson } from 'interfaces/notification-json';
import { route } from 'laroute';
import { action, observable } from 'mobx';
import Notification from 'models/notification';
import NotificationStack, { idFromJson } from 'models/notification-stack';
import NotificationType from 'models/notification-type';
import { NotificationContextData } from 'notifications-context';
import Store from 'stores/store';

export default class NotificationStackStore extends Store {
  @observable readonly stacks = new Map<string, NotificationStack>();
  @observable readonly types = new Map<string, NotificationType>();

  get notifications() {
    return this.root.notificationStore.notifications;
  }

  @action
  flushStore() {
    this.stacks.clear();
    this.types.clear();
  }

  @action
  loadMore(cursor: JSON, context: NotificationContextData) {
    const params = {
      data: { cursor, unread: context.unreadOnly },
      dataType: 'json',
      url: route('notifications.index'),
    };

    return $.ajax(params).then(action((response: NotificationBundleJson) => {
      this.updateWithBundle(response);
    }));
  }

  @action
  updateWithBundle(bundle: NotificationBundleJson) {
    bundle.types?.forEach((json) => this.updateWithTypeJson(json));
    bundle.stacks?.forEach((json) => this.updateWithStackJson(json));
    bundle.notifications?.forEach((json) => this.updateWithNotificationJson(json));
  }

  private updateWithNotificationJson(json: NotificationJson) {
    let notification = this.notifications.get(json.id);
    if (notification == null) {
      notification = new Notification(json.id);
      this.notifications.set(notification.id, notification);
    }
    notification.updateFromJson(json);
    this.stacks.get(notification.stackId)?.notifications.set(notification.id, notification);
  }

  private updateWithStackJson(json: NotificationStackJson) {
    let stack = this.stacks.get(idFromJson(json));
    if (stack == null) {
      stack = new NotificationStack(this, json.object_id, json.object_type, json.name);
      this.stacks.set(stack.id, stack);
    }
    stack.updateWithJson(json);
    this.types.get(stack.objectType)?.stacks.set(stack.id, stack);
  }

  private updateWithTypeJson(json: NotificationTypeJson) {
    let type = this.types.get(json.name);
    if (type == null) {
      type = new NotificationType(this, json.name);
      this.types.set(type.name, type);
    }
    type.updateWithJson(json);
  }
}
