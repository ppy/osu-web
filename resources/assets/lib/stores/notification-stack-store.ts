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
import { dispatchListener } from 'app-dispatcher';
import DispatchListener from 'dispatch-listener';
import NotificationJson, { NotificationBundleJson, NotificationStackJson, NotificationTypeJson } from 'interfaces/notification-json';
import { action, observable } from 'mobx';
import LegacyPmNotification from 'models/legacy-pm-notification';
import Notification from 'models/notification';
import NotificationStack, { idFromJson } from 'models/notification-stack';
import NotificationType, { Name as NotificationTypeName  } from 'models/notification-type';
import { nameToCategory } from 'notification-maps/category';
import { NotificationEventMoreLoaded, NotificationEventNew } from 'notifications/notification-events';
import { NotificationIdentity, resolveStackId } from 'notifications/notification-identity';
import { NotificationResolver } from 'notifications/notification-resolver';
import NotificationStore from './notification-store';

@dispatchListener
export default class NotificationStackStore implements DispatchListener {
  @observable readonly legacyPm = new LegacyPmNotification();
  @observable readonly stacks = new Map<string, NotificationStack>();
  @observable readonly types = new Map<string | null, NotificationType>();
  private readonly resolver = new NotificationResolver();

  constructor(protected notificationStore: NotificationStore) {}

  @action
  flushStore() {
    this.stacks.clear();
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
    return this.stacks.get(resolveStackId(identity));
  }

  @action
  handleDispatchAction(dispatched: DispatcherAction) {
    if (dispatched instanceof NotificationEventNew) {
      this.handleNotificationEventNew(dispatched);
    } else if (dispatched instanceof NotificationEventMoreLoaded) {
      this.handleNotificationEventMoreLoaded(dispatched);
    }
  }

  @action
  handleNotificationEventMoreLoaded(event: NotificationEventMoreLoaded) {
    if (!event.context.unreadOnly) {
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

    // FIXME: we need the notification to include if the stack already exists server side :|
    if (stack == null) {
      stack = new NotificationStack(json.object_id, json.object_type, nameToCategory[json.name], this.resolver);
      this.stacks.set(stack.id, stack);
    }

    stack.notifications.set(notification.id, notification);
    stack.total++;

    type.stacks.set(stack.id, stack);
    type.total++;
  }

  /**
   * A generator that returns stacks of a specified notifiable type.
   * Because this is neither computed nor observable, in order to use this within an observer,
   * another observable value should be observed in render.
   *
   * @param name the notifiable type of the notification
   */
  *stacksOfType(name: NotificationTypeName) {
    const type = this.types.get(name);
    const cursorId = type?.cursor?.id ?? 0;

    for (const [, stack] of this.stacks) {
      // don't include stacks that are past the cursor for the type
      // this is to prevent gaps in loaded stacks when switching filters
      if ((name == null || stack.type === name) && type?.cursor !== undefined && stack.first.id >= cursorId) yield stack;
    }
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

    this.stacks.get(notification.stackId)?.notifications.set(notification.id, notification);
  }

  private updateWithStackJson(json: NotificationStackJson) {
    let stack = this.stacks.get(idFromJson(json));
    if (stack == null) {
      stack = new NotificationStack(json.object_id, json.object_type, nameToCategory[json.name], this.resolver);
      this.stacks.set(stack.id, stack);
    }
    stack.updateWithJson(json);
    this.types.get(stack.objectType)?.stacks.set(stack.id, stack);
  }

  private updateWithTypeJson(json: NotificationTypeJson) {
    let type = this.types.get(json.name);
    if (type == null) {
      type = new NotificationType(json.name, this.resolver);
      this.types.set(type.name, type);
    }
    type.updateWithJson(json);
  }
}
