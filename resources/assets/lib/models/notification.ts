/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import NotificationJson from 'interfaces/notification-json';
import * as _ from 'lodash';
import { computed, observable } from 'mobx';
import { categoryGroupKey, nameToCategory } from 'notification-maps/category';
import { displayType } from 'notification-maps/type';

export default class Notification {
  createdAtJson?: string;
  details?: any;
  id: number;
  @observable isRead: boolean = false;
  name?: string;
  objectId?: number;
  objectType?: string;
  sourceUserId?: number;

  @computed get category() {
    return nameToCategory[this.name || ''];
  }

  @computed get categoryGroupKey() {
    return categoryGroupKey(this);
  }

  @computed get displayType() {
    return displayType(this);
  }

  constructor(id: number) {
    this.id = id;
  }

  updateFromJson = (json: NotificationJson) => {
    this.createdAtJson = json.created_at;
    this.isRead = json.is_read;
    this.name = json.name;
    this.objectId = json.object_id;
    this.objectType = json.object_type;
    this.sourceUserId = json.source_user_id;

    this.details = {};

    if (typeof json.details === 'object') {
      _.forEach(json.details, (value, key) => {
        this.details[_.camelCase(key)] = value;
      });
    }
  }
}
