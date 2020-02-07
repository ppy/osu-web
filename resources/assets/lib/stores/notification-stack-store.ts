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

import DispatcherAction from 'actions/dispatcher-action';
import { UserLoginAction, UserLogoutAction } from 'actions/user-login-actions';
import { dispatchListener } from 'app-dispatcher';
import DispatchListener from 'dispatch-listener';
import NotificationJson, { NotificationBundleJson, NotificationStackJson, NotificationTypeJson } from 'interfaces/notification-json';
import { action, computed, observable } from 'mobx';
import LegacyPmNotification from 'models/legacy-pm-notification';
import Notification from 'models/notification';
import NotificationStack, { idFromJson } from 'models/notification-stack';
import NotificationType, { Name as NotificationTypeName  } from 'models/notification-type';
import { categoryFromName } from 'notification-maps/category';
import { NotificationEventMoreLoaded, NotificationEventNew, NotificationEventRead } from 'notifications/notification-events';
import { fromJson, NotificationIdentity, resolveIdentityType, resolveStackId } from 'notifications/notification-identity';
import { NotificationResolver } from 'notifications/notification-resolver';
import NotificationStore from './notification-store';

@dispatchListener
export default class NotificationStackStore implements DispatchListener {
  @observable readonly legacyPm = new LegacyPmNotification();
  @observable readonly types = new Map<string | null, NotificationType>();
  private readonly resolver = new NotificationResolver();

  get allStacks() {
    return this.allType.stacks;
  }

  get allType() {
    return this.getOrCreateType({ objectType: null });
  }

  get isEmpty() {
    return this.types.size === 1 && this.allStacks.size === 0;
  }

  @computed get total() {
    return this.allType.total;
  }

  set total(value: number) {
    this.allType.total = value;
  }

  constructor(protected notificationStore: NotificationStore) {
    // 'all' type should always exist; makes testing deterministic.
    this.getOrCreateType({ objectType: null });
  }

  @action
  flushStore() {
    this.types.clear();
  }

  getOrCreateType(identity: NotificationIdentity) {
    let type = this.types.get(identity.objectType);
    if (type == null) {
      type = new NotificationType(identity.objectType, this.resolver);
      this.types.set(type.name, type);
    }

    return type;
  }

  getStack(identity: NotificationIdentity) {
    return this.types.get(identity.objectType)?.stacks.get(resolveStackId(identity));
  }

  @action
  handleDispatchAction(dispatched: DispatcherAction) {
    if (dispatched instanceof NotificationEventNew) {
      this.handleNotificationEventNew(dispatched);
    } else if (dispatched instanceof NotificationEventMoreLoaded) {
      this.handleNotificationEventMoreLoaded(dispatched);
    } else if (dispatched instanceof NotificationEventRead) {
      this.handleNotificationEventRead(dispatched);
    } else if (dispatched instanceof UserLoginAction || dispatched instanceof UserLogoutAction) {
      this.flushStore();
    }
  }

  @action
  handleNotificationEventMoreLoaded(event: NotificationEventMoreLoaded) {
    if (!event.context.isWidget) {
      this.updateWithBundle(event.data);
    }
  }

  @action
  handleNotificationEventNew(event: NotificationEventNew) {
    // TODO: maybe use NotificationIdentityJson instead?

    const json = event.data;

    let notification = this.notificationStore.get(json.id);
    if (notification == null) {
      notification = Notification.fromJson(json);
      this.notificationStore.add(notification);
    } else {
      notification.updateFromJson(json);
    }

    const identity = notification.identity;
    const type = this.getOrCreateType(identity);
    let stack = this.getStack(identity);

    if (stack == null) {
      stack = new NotificationStack(json.object_id, json.object_type, categoryFromName(json.name), this.resolver);
    }

    if (!stack.notifications.has(notification.id)) {
      stack.total++;
      type.total++;
      this.total++;
    }

    stack.add(notification);
    type.stacks.set(stack.id, stack);
    this.allStacks.set(stack.id, stack);
  }

  @action
  handleNotificationEventRead(event: NotificationEventRead) {
    if (event.data.length === 0) return;
    const first = event.data[0];
    const identityType = resolveIdentityType(first);

    if (identityType === 'stack') {
      const stack = this.getStack(first);
      if (stack != null) {
        stack.isRead = true;
      }
    }
  }

  orderedStacksOfType(name: NotificationTypeName) {
    return this.stacksOfType(name).sort((x, y) => y.displayOrder - x.displayOrder);
  }

  /**
   * Returns stacks of a specified notifiable type.
   * Because this is neither computed nor observable, in order to use this within an observer,
   * another observable value should be observed in render.
   *
   * @param name the notifiable type of the notification
   */
  stacksOfType(name: NotificationTypeName) {
    const type = this.types.get(name);
    const stacks: NotificationStack[] = [];

    if (type == null) return stacks;

    const cursorId = type.cursor?.id ?? 0;

    for (const [, stack] of type.stacks) {
      // don't include stacks that are past the cursor for the type
      // this is to prevent gaps in loaded stacks when switching filters
      if (type?.cursor !== undefined && stack.displayOrder >= cursorId) stacks.push(stack);
    }

    return stacks;
  }

  @action
  updateWithBundle(bundle: NotificationBundleJson) {
    bundle.types?.forEach((json) => this.updateWithTypeJson(json));
    bundle.stacks?.forEach((json) => this.updateWithStackJson(json));
    bundle.notifications?.forEach((json) => this.updateWithNotificationJson(json));
  }

  private updateWithNotificationJson(json: NotificationJson) {
    let notification = this.notificationStore.get(json.id);
    if (notification == null) {
      notification = Notification.fromJson(json);
      this.notificationStore.add(notification);
    } else {
      notification.updateFromJson(json);
    }

    const type = this.getOrCreateType(notification.identity);
    type.stacks.get(notification.stackId)?.add(notification);
  }

  private updateWithStackJson(json: NotificationStackJson) {
    const type = this.getOrCreateType(fromJson(json));
    let stack = type.stacks.get(idFromJson(json));
    if (stack == null) {
      stack = NotificationStack.fromJson(json, this.resolver);
      type.stacks.set(stack.id, stack);
      this.allType.stacks.set(stack.id, stack);
    } else {
      stack.updateWithJson(json);
    }
  }

  private updateWithTypeJson(json: NotificationTypeJson) {
    this.getOrCreateType({ objectType: json.name }).updateWithJson(json);
  }
}
