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
import { action, computed, observable } from 'mobx';
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
  get firstUnread() {
    // array accessor doesn't declare undefined type return.
    return this.unreadNotifications[0] as Notification | undefined;
  }

  @computed
  get id() {
    return `${this.objectType}-${this.objectId}-${this.name}`;
  }

  @computed
  get isSingle() {
    return this.notifications.size === 1;
  }

  @computed
  get unreadCount() {
    return this.unreadNotifications.length;
  }

  @computed
  get unreadNotifications() {
    return [...this.notifications.values()].filter((x) => !x.isRead);
  }

  constructor(public objectId: number, public objectType: string, public name: string) {}

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
  updateWithJson(json: NotificationStackJson) {
    this.cursor = json.cursor;
    this.total = json.total;
  }
}

export function idFromJson(json: NotificationStackJson) {
  return `${json.object_type}-${json.object_id}-${json.name}`;
}
