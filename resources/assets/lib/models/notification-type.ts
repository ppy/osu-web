// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { NotificationTypeJson } from 'interfaces/notification-json';
import { action, computed, observable } from 'mobx';
import NotificationStack from 'models/notification-stack';
import { NotificationContextData } from 'notifications-context';
import { NotificationCursor } from 'notifications/notification-cursor';
import NotificationDeletable from 'notifications/notification-deletable';
import { NotificationIdentity } from 'notifications/notification-identity';
import NotificationReadable from 'notifications/notification-readable';
import { NotificationResolver } from 'notifications/notification-resolver';

// List is in the order they appear on the notification filter.
export const typeNames = [null, 'user', 'beatmapset', 'forum_topic', 'news_post', 'build', 'channel'] as const;
export type Name = (typeof typeNames)[number];

export function getValidName(value: unknown) {
  const casted = value as Name;
  if (typeNames.indexOf(casted) > -1) {
    return casted;
  }

  return typeNames[0];
}

export default class NotificationType implements NotificationReadable, NotificationDeletable {
  @observable cursor?: NotificationCursor | null;
  @observable isDeleting = false;
  @observable isLoading = false;
  @observable isMarkingAsRead = false;
  @observable stacks = new Map<string, NotificationStack>();
  @observable total = 0;

  @computed get hasMore() {
    // undefined means not loaded yet.
    return this.cursor !== null && this.stackNotificationCount < this.total;
  }

  @computed get hasVisibleNotifications() {
    return (this.total > 0 && this.stacks.size > 0);
  }

  get identity(): NotificationIdentity {
    return {
      objectType: this.name,
    };
  }

  @computed get isEmpty() {
    return this.total <= 0;
  }

  @computed get stackNotificationCount() {
    return [...this.stacks.values()].reduce((acc, stack) => acc + stack.total, 0);
  }

  constructor(readonly name: string | null, readonly resolver: NotificationResolver) {}

  static fromJson(json: NotificationTypeJson, resolver: NotificationResolver) {
    const obj = new NotificationType(json.name, resolver);
    obj.updateWithJson(json);
    return obj;
  }

  @action
  delete() {
    this.resolver.delete(this);
  }

  @action
  loadMore(context: NotificationContextData) {
    if (this.cursor === null) return;

    this.isLoading = true;

    this.resolver.loadMore(this.identity, context, this.cursor)
      .always(action(() => {
        this.isLoading = false;
      }));
  }

  @action
  markTypeAsRead() {
    this.resolver.queueMarkAsRead(this);
  }

  @action
  removeStack(stack: NotificationStack) {
    const exists = this.stacks.delete(stack.id);
    if (exists) this.total -= stack.total;
    return exists;
  }

  @action
  updateWithJson(json: NotificationTypeJson) {
    this.cursor = json.cursor;
    this.total = json.total;
  }
}
