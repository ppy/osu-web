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

import { dispatchListener } from 'app-dispatcher';
import DispatchListener from 'dispatch-listener';
import { NotificationBundleJson } from 'interfaces/notification-json';
import { action, computed, observable } from 'mobx';
import { NotificationEventMoreLoaded, NotificationEventNew, NotificationEventRead } from 'notifications/notification-events';
import { NotificationIdentity, resolveIdentityType, resolveStackId } from 'notifications/notification-identity';
import NotificationStackStore from './notification-stack-store';

@dispatchListener
export default class UnreadNotificationStackStore extends NotificationStackStore implements DispatchListener {
  @observable total = 0;
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
    this.total++;
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
        this.handleType(first, event.readCount);
        break;

      case 'stack':
        this.handleStack(first, event.readCount);
        break;

      case 'notification':
        event.data.forEach(this.handleNotification);
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

  private handleNotification = (identity: NotificationIdentity) => {
    if (resolveIdentityType(identity) !== 'notification') return;

    const notification = this.notificationStore.get(identity.id ?? 0);
    const stack = this.getStack(identity);
    const type = this.getOrCreateType(identity);
    // TODO; check if notification and stackNotification is necessary;
    const stackNotification = stack?.notifications.get(identity.id ?? 0);
    if (notification != null) {
      if (!notification.isRead) {
        stack?.remove(notification);
        if (type != null) type.total--;

        this.total--;
        notification.isRead = true;
      }

      return;
    }

    if (stackNotification == null) {
      // notification may not have been loaded yet.
      // not known anywhere, skip
      if (stack == null || type == null || identity.id == null) return;

      // notification is past cursor, update counts
      if (identity.id < (stack.cursor?.id ?? 0)) {
        this.total--;
        stack.total--;
        type.total--;
      }
    }
  }

  private handleStack(identity: NotificationIdentity, readCount: number) {
    const stack = this.getStack(identity);
    const key = resolveStackId(identity);
    if (stack == null) {
      if (!this.deletedStacks.has(key)) {
        this.total -= readCount;
      }

      return;
    }

    this.deletedStacks.add(key);

    stack.isRead = true;
    this.stacks.delete(key);
    this.total -= stack.total;

    const type = this.getOrCreateType(identity);
    type.removeStack(stack);
  }

  private handleType(identity: NotificationIdentity, readCount: number) {
    const type = this.getOrCreateType(identity);
    this.total -= type.total;

    type.stacks.forEach((stack) => stack.notifications.forEach((notification) => notification.isRead = true));
    this.types.delete(identity.objectType);
  }
}
