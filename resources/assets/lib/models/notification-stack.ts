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
import core from 'osu-core-singleton';

export default class NotificationStack {
  @observable cursor: JSON | null = null;
  @observable isLoading = false;
  @observable notifications = new Map<number, Notification>();
  @observable total = 0;

  private readonly store = core.dataStore.notificationStackStore;

  @computed
  get first() {
    return this.notifications.values().next().value as Notification | undefined;
  }

  @computed
  get id() {
    return `${this.objectType}-${this.objectId}-${this.name}`;
  }

  @computed
  get isSingle() {
    return this.notifications.size === 1;
  }

  constructor(
    readonly objectId: number,
    readonly objectType: string,
    readonly name: string,
  ) {}

  @action
  loadMore() {
    if (this.cursor == null) { return; }

    this.isLoading = true;
    const data = { cursor: this.cursor };
    $.ajax({ url: route('notifications.index'), dataType: 'json', data })
    .then(action((response: NotificationBundleJson) => {
      this.store.updateWithBundle(response);
    })).always(action(() => {
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
          this.notifications.delete(notification.id);
          core.dataStore.notificationStore.unreadCount--;
          this.total--;
        }
        disposer();
      });
    });

    core.dataStore.notificationStore.queueMarkAsRead(notification);
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
