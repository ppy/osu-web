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
import { NotificationEventRead } from 'notifications/notification-events';
import { NotificationIdentity, resolveIdentityType, resolveStackId } from 'notifications/notification-identity';
import NotificationStackStore from './notification-stack-store';

export default class UnreadNotificationStackStore extends NotificationStackStore {
  @observable total = 0;

  @action
  handleNotificationEventNew() {
    this.total++;
  }

  @action
  handleNotificationEventRead(event: NotificationEventRead) {
    const identityType = resolveIdentityType(event.data);
    switch (identityType) {
      case 'type':
        this.handleType(event.data);
        break;

      case 'stack':
        this.handleStack(event.data);
        break;

      case 'notification':
        this.handleNotification(event.data);
        break;
    }
  }

  @action
  updateWithBundle(bundle: NotificationBundleJson) {
    super.updateWithBundle(bundle);

    if (bundle.unread_count != null) {
      this.total = bundle.unread_count;
    }
  }

  private handleNotification(identity: NotificationIdentity) {
    if (resolveIdentityType(identity) !== 'notification') return;

    const notification = this.getNotification(identity);
    const stack = this.getStack(identity);
    const type = this.getType(identity);

    if (notification != null) {
      if (!notification.isRead) {
        this.total--;
        stack?.remove(notification);
        if (type != null) type.total--;

        notification.isRead = true;
      }
    }

    this.total--;
    if (type != null) type.total--;
    if (stack != null) stack.total--;
  }

  private handleStack(identity: NotificationIdentity) {
    const stack = this.getStack(identity);
    if (stack == null) return;

    stack.notifications.forEach((notification) => notification.isRead = true);
    this.stacks.delete(resolveStackId(identity));
    this.total -= stack.total;

    const type = this.getType(identity);
    if (type == null) return;
    type.removeStack(stack);
  }

  private handleType(identity: NotificationIdentity) {
    const type = this.getType(identity);
    if (type == null) return;

    type.stacks.forEach((stack) => stack.notifications.forEach((notification) => notification.isRead = true));
    this.types.delete(identity.objectType);
    this.total -= type.total;
  }
}
