// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { dispatchListener } from 'app-dispatcher';
import DispatchListener from 'dispatch-listener';
import { NotificationBundleJson } from 'interfaces/notification-json';
import { action, computed } from 'mobx';
import NotificationType from 'models/notification-type';
import { NotificationEventMoreLoaded, NotificationEventNew, NotificationEventRead } from 'notifications/notification-events';
import { NotificationIdentity, resolveIdentityType, resolveStackId } from 'notifications/notification-identity';
import NotificationStackStore from './notification-stack-store';

@dispatchListener
export default class WidgetNotificationStackStore extends NotificationStackStore implements DispatchListener {
  private deletedStacks = new Set<string>();

  @computed get totalWithPm() {
    return this.total + this.legacyPm.count;
  }

  @action
  handleNotificationEventMoreLoaded(event: NotificationEventMoreLoaded) {
    if (event.context.isWidget) {
      this.updateWithBundle(event.data);
    }
  }

  @action
  handleNotificationEventNew(event: NotificationEventNew) {
    if (event.data.is_read) return;

    super.handleNotificationEventNew(event);
  }

  @action
  handleNotificationEventRead(event: NotificationEventRead) {
    // identity types currently aren't mixed in the event,
    // so readCount can be applied for the whole group.
    if (event.data.length === 0) return;
    const first = event.data[0];
    const identityType = resolveIdentityType(first);

    switch (identityType) {
      case 'type':
        this.handleTypeRead(first, event.readCount);
        break;

      case 'stack':
        this.handleStackRead(first, event.readCount);
        break;

      case 'notification':
        event.data.forEach(this.handleNotificationRead);
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

  private handleNotificationRead = (identity: NotificationIdentity) => {
    if (resolveIdentityType(identity) !== 'notification') return;

    const notification = this.notificationStore.get(identity.id ?? 0);
    const stack = this.getStack(identity);
    const type = this.getOrCreateType(identity);
    // TODO; check if notification and stackNotification is necessary;
    const stackNotification = stack?.notifications.get(identity.id ?? 0);
    if (notification != null) {
      if (!notification.isRead) {
        stack?.remove(notification);
        type.total--;

        this.total--;
        notification.isRead = true;
      }

      return;
    }

    if (stackNotification == null) {
      // notification may not have been loaded yet.
      // not known anywhere, skip
      if (stack == null || identity.id == null) return;

      // notification is past cursor, update counts
      if (identity.id < (stack.cursor?.id ?? 0)) {
        this.total--;
        stack.total--;
        type.total--;
      }
    }
  }

  private handleStackRead(identity: NotificationIdentity, readCount: number) {
    const stack = this.getStack(identity);
    const key = resolveStackId(identity);

    if (stack == null) {
      if (!this.deletedStacks.has(key)) {
        this.deletedStacks.add(key);
        this.total -= readCount;
      }

      return;
    }

    this.deletedStacks.add(key);

    stack.isRead = true;
    this.allStacks.delete(key);
    this.total -= stack.total;

    const type = this.getOrCreateType(identity);
    type.removeStack(stack);
  }

  private handleTypeRead(identity: NotificationIdentity, readCount: number) {
    const type = this.getOrCreateType(identity);

    if (type.name === null) {
      for (const [key, value] of this.types) {
        if (key === null) continue;
        this.typeRead(value);
      }

      type.total = 0;
    } else {
      this.typeRead(type);
    }
  }

  private typeRead(type: NotificationType) {
    type.stacks.forEach((stack) => {
      stack.isRead = true;
      this.allType.removeStack(stack);
    });

    this.types.delete(type.name);
  }
}
