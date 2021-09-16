// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DispatcherAction from 'actions/dispatcher-action';
import { UserLoginAction } from 'actions/user-login-actions';
import { dispatchListener } from 'app-dispatcher';
import DispatchListener from 'dispatch-listener';
import NotificationJson, { NotificationBundleJson, NotificationStackJson, NotificationTypeJson } from 'interfaces/notification-json';
import { action, computed, makeObservable, observable } from 'mobx';
import LegacyPmNotification from 'models/legacy-pm-notification';
import Notification from 'models/notification';
import NotificationStack, { idFromJson } from 'models/notification-stack';
import NotificationType, { Name as NotificationTypeName  } from 'models/notification-type';
import { categoryFromName } from 'notification-maps/category';
import { NotificationEventDelete, NotificationEventMoreLoaded, NotificationEventNew, NotificationEventRead } from 'notifications/notification-events';
import { fromJson, NotificationIdentity, resolveIdentityType, resolveStackId } from 'notifications/notification-identity';
import { NotificationResolver } from 'notifications/notification-resolver';
import NotificationStore from './notification-store';

@dispatchListener
export default class NotificationStackStore implements DispatchListener {
  @observable readonly legacyPm = new LegacyPmNotification();
  @observable readonly types = new Map<string | null, NotificationType>();
  private deletedStacks = new Set<string>();
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

    makeObservable(this);
  }

  @action
  flushStore() {
    this.types.clear();
  }

  @action
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
    if (dispatched instanceof NotificationEventDelete) {
      this.handleNotificationEventDelete(dispatched);
    } else if (dispatched instanceof NotificationEventNew) {
      this.handleNotificationEventNew(dispatched);
    } else if (dispatched instanceof NotificationEventMoreLoaded) {
      this.handleNotificationEventMoreLoaded(dispatched);
    } else if (dispatched instanceof NotificationEventRead) {
      this.handleNotificationEventRead(dispatched);
    } else if (dispatched instanceof UserLoginAction) {
      this.flushStore();
    }
  }

  @action
  handleNotificationEventDelete(event: NotificationEventDelete) {
    this.removeByEvent(event);
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
    // Base stack store (this class) shows read notifications so nothing
    // needs to be handled here as the per-Notification-model read marking
    // is done by NotificationStore.
    return;
  }

  orderedStacksOfType(name: NotificationTypeName) {
    return this.stacksOfType(name).sort((x, y) => y.displayOrder - x.displayOrder);
  }

  @action
  removeByEvent(event: NotificationEventDelete | NotificationEventRead) {
    for (const identity of event.data) {
      const identityType = resolveIdentityType(identity);

      switch (identityType) {
        case 'type':
          this.removeByType(identity);
          break;

        case 'stack':
          // FIXME: can't apply event read count to all now.
          this.removeByStack(identity, event.readCount);
          break;

        case 'notification':
          this.removeByNotification(identity);
          break;
      }
    }
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

  private removeByNotification = (identity: NotificationIdentity) => {
    if (identity.id == null) return;

    const stack = this.getStack(identity);
    const type = this.getOrCreateType(identity);

    const stackNotification = stack?.notifications.get(identity.id);

    if (stackNotification == null) {
      // Notification may not have been loaded yet.
      // Update counts if stack is loaded but the notification is past
      // the cursor (which is descending).
      if (stack != null && identity.id < (stack.cursor?.id ?? 0)) {
        this.total--;
        stack.total--;
        type.total--;
      }
    } else {
      stack?.remove(stackNotification);
      type.total--;

      this.total--;
    }
  };

  private removeByStack(identity: NotificationIdentity, readCount: number) {
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

    this.allStacks.delete(key);
    this.total -= stack.total;

    const type = this.getOrCreateType(identity);
    type.removeStack(stack);
  }

  private removeByType(identity: NotificationIdentity) {
    const type = this.getOrCreateType(identity);

    if (type.name === null) {
      for (const [key, value] of this.types) {
        if (key === null) continue;
        this.removeType(value);
      }

      type.total = 0;
    } else {
      this.removeType(type);
    }
  }

  private removeType(type: NotificationType) {
    type.stacks.forEach((stack) => {
      this.allType.removeStack(stack);
    });

    type.total = 0;
    this.types.delete(type.name);
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
