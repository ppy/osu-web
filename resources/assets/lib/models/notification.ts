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

import NotificationJson from 'interfaces/notification-json';
import { camelCase, forEach } from 'lodash';
import { computed, observable } from 'mobx';
import { categoryFromName, categoryGroupKey } from 'notification-maps/category';
import { displayType } from 'notification-maps/type';
import { NotificationIdentity } from 'notifications/notification-identity';
import NotificationReadable from 'notifications/notification-readable';

export default class Notification implements NotificationReadable {
  createdAtJson?: string;
  details?: any;
  @observable isMarkingAsRead = false;
  @observable isRead = false;
  name?: string;
  objectId?: number;
  sourceUserId?: number;

  @computed get canMarkRead() {
    return this.id > 0 && !this.isRead;
  }

  @computed get category() {
    return categoryFromName(this.name ?? '');
  }

  @computed get categoryGroupKey() {
    return categoryGroupKey(this);
  }

  @computed get displayType() {
    return displayType(this);
  }

  get identity(): NotificationIdentity {
    return {
      category: this.category,
      id: this.id,
      objectId: this.objectId,
      objectType: this.objectType,
    };
  }

  @computed get messageGroup() {
    if (this.objectType === 'channel') {
      const replacements = {
        title: this.details.title,
        username: this.details.username,
      };

      const key = `notifications.item.${this.objectType}.${this.category}.${this.details.type}.${this.name}_group`;

      return osu.trans(key, replacements);
    }

    return this.details.title;
  }

  @computed get stackId() {
    return `${this.objectType}-${this.objectId}-${this.category}`;
  }

  constructor(readonly id: number, readonly objectType: string) {}

  static fromJson(json: NotificationJson): Notification {
    const obj = new Notification(json.id, json.object_type);
    return obj.updateFromJson(json);
  }

  updateFromJson = (json: NotificationJson) => {
    this.createdAtJson = json.created_at;
    this.isRead = json.is_read;
    this.name = json.name;
    this.objectId = json.object_id;
    this.sourceUserId = json.source_user_id;

    this.details = {};

    if (typeof json.details === 'object') {
      forEach(json.details, (value, key) => {
        this.details[camelCase(key)] = value;
      });
    }

    return this;
  }
}
