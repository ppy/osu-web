// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { NotificationStackJson } from 'interfaces/notification-json';
import { action, computed, observable } from 'mobx';
import Notification from 'models/notification';
import { categoryFromName } from 'notification-maps/category';
import { NotificationContextData } from 'notifications-context';
import { NotificationCursor } from 'notifications/notification-cursor';
import { NotificationIdentity } from 'notifications/notification-identity';
import NotificationReadable from 'notifications/notification-readable';
import { NotificationResolver } from 'notifications/notification-resolver';

export default class NotificationStack implements NotificationReadable {
  @observable cursor: NotificationCursor | null = null;
  @observable displayOrder = 0;
  @observable isLoading = false;
  @observable isMarkingAsRead = false;
  @observable notifications = new Map<number, Notification>();
  @observable total = 0;

  // This is for cases when there are more notifications available to be loaded
  // but all the currently loaded notifications have seen removed, allowing the last known notification
  // to be shown in the stack's header instead of nothing.
  @observable private lastNotification: Notification | null = null;

  @computed
  get canMarkAsRead() {
    for (const [, notifications] of this.notifications) {
      if (notifications.canMarkRead) return true;
    }

    return false;
  }

  @computed
  get first() {
    return this.orderedNotifications[0] ?? this.lastNotification;
  }

  @computed
  get hasVisibleNotifications() {
    return this.notifications.size > 0 || this.objectType === 'legacy_pm';
  }

  @computed
  get hasMore() {
    return !(this.notifications.size >= this.total || this.cursor == null);
  }

  @computed
  get id() {
    return `${this.objectType}-${this.objectId}-${this.category}`;
  }

  set isRead(value: boolean) {
    this.notifications.forEach((notification) => notification.isRead = value);
  }

  @computed
  get isSingle() {
    return this.total === 1;
  }

  get identity(): NotificationIdentity {
    return {
      category: this.category,
      objectId: this.objectId,
      objectType: this.objectType,
    };
  }

  get isLegacyPm() {
    return this.objectType === 'legacy_pm';
  }

  @computed
  get orderedNotifications() {
    return [...this.notifications.values()].sort((x, y) => y.id - x.id);
  }

  get type() {
    return this.objectType;
  }

  constructor(
    readonly objectId: number,
    readonly objectType: string,
    readonly category: string,
    readonly resolver: NotificationResolver,
  ) {}

  static fromJson(json: NotificationStackJson, resolver: NotificationResolver) {
    const obj = new NotificationStack(json.object_id, json.object_type, categoryFromName(json.name), resolver);
    obj.updateWithJson(json);
    return obj;
  }

  @action
  add(notification: Notification) {
    this.notifications.set(notification.id, notification);
    this.displayOrder = Math.max(notification.id, this.displayOrder);
  }

  @action
  loadMore(context: NotificationContextData) {
    if (this.cursor == null) { return; }

    this.isLoading = true;

    this.resolver.loadMore(this.identity, context, this.cursor)
    .always(action(() => {
      this.isLoading = false;
    }));
  }

  @action
  markAsRead(notification?: Notification) {
    // not from this stack, ignore.
    if (notification == null || !this.notifications.has(notification.id)) { return; }
    this.resolver.queueMarkAsRead(notification);
  }

  @action
  markStackAsRead() {
    this.resolver.queueMarkAsRead(this);
  }

  @action
  remove(notification: Notification) {
    if (this.notifications.size === 1) {
      // doesn't matter if the notification that's being removed doesn't actually exist in the stack,
      // this can still be set.
      this.lastNotification = this.notifications.values().next().value;
    }

    const existed = this.notifications.delete(notification.id);
    if (existed) this.total--;
    return existed;
  }

  @action
  updateWithJson(json: NotificationStackJson) {
    this.cursor = json.cursor;
    this.total = json.total;
  }
}

export function idFromJson(json: NotificationStackJson) {
  return `${json.object_type}-${json.object_id}-${categoryFromName(json.name)}`;
}
