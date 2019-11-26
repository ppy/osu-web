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

import { NotificationBundleJson, NotificationStackJson } from 'interfaces/notification-bundle-json';
import { route } from 'laroute';
import { action, computed, observable, observe, runInAction } from 'mobx';
import Notification from 'models/notification';
import { NotificationContextData } from 'notifications-context';
import core from 'osu-core-singleton';
import NotificationStackStore from 'stores/notification-stack-store';

export default class NotificationStack {
  @observable cursor: JSON | null = null;
  @observable isLoading = false;
  @observable notifications = new Map<number, Notification>();
  @observable total = 0;

  @observable private lastNotification: Notification | null = null;
  private readonly rootStore = core.dataStore;

  @computed
  get first() {
    return this.notifications.values().next().value ?? this.lastNotification;
  }

  @computed
  get id() {
    return `${this.objectType}-${this.objectId}-${this.name}`;
  }

  @computed
  get hasVisibleNotifiations() {
    return this.notifications.size > 0;
  }

  @computed
  get isSingle() {
    return this.total === 1;
  }

  constructor(
    private readonly store: NotificationStackStore,
    readonly objectId: number,
    readonly objectType: string,
    readonly name: string,
  ) {}

  @action
  add(notification: Notification) {
    this.notifications.set(notification.id, notification);
  }

  @action
  loadMore(context: NotificationContextData) {
    if (this.cursor == null) { return; }

    this.isLoading = true;

    this.store.loadMore(this.cursor, context)
    .always(action(() => {
      this.isLoading = false;
    }));
  }

  @action
  markAsRead(notification?: Notification) {
    // not from this stack, ignore.
    if (notification == null || this.notifications.get(notification.id) == null) { return; }
    const disposer = observe(notification, 'isRead', (change) => {
      runInAction(() => {
        if (change.newValue === true && change.newValue !== change.oldValue) {
          this.remove(notification);
          core.dataStore.notificationStore.unreadCount--;
          this.total--;
        }
        disposer();
      });
    });

    core.dataStore.notificationStore.queueMarkAsRead(notification);
  }

  @action
  markStackAsRead() {
    // TODO
  }

  @action
  remove(notification: Notification) {
    if (this.notifications.size === 1) {
      // doesn't matter if the notification that's being removed doesn't actually exist in the stack,
      // this can still be set.
      this.lastNotification = this.notifications.values().next().value;
    }

    this.notifications.delete(notification.id);
  }

  @action
  updateWithJson(json: NotificationStackJson) {
    this.cursor = json.cursor;
    this.total = json.total;
  }
}

export function idFromJson(json: NotificationStackJson) {
  return `${json.object_type}-${json.object_id}-${json.name}`;
}
