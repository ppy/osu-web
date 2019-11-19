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

import { NotificationStackJson } from 'interfaces/notification-bundle-json';
import { action, computed, observable } from 'mobx';
import Notification from 'models/notification';

export default class NotificationStack {
  @observable cursor: JSON | null = null;
  @observable notifications = new Map<number, Notification>();
  @observable total = 0;

  @computed
  get first(): Notification | undefined {
    return this.notifications.values().next().value;
  }

  @computed
  get id() {
    return `${this.objectType}-${this.objectId}`;
  }

  @computed
  get isSingle() {
    return this.notifications.size === 1;
  }

  constructor(public objectId: number, public objectType: string) {}

  @action
  updateWithJson(json: NotificationStackJson) {
    this.cursor = json.cursor;
    this.total = json.total;
  }
}

export function idFromJson(json: NotificationStackJson) {
  return `${json.object_type}-${json.object_id}`;
}
