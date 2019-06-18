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
