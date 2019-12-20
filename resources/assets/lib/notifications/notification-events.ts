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
import NotificationJson, { NotificationBundleJson } from 'interfaces/notification-json';
import { NotificationContextData } from 'notifications-context';
import { fromJson, NotificationIdentity, NotificationIdentityJson } from 'notifications/notification-identity';

// tslint:disable: max-classes-per-file
export interface NotificationEventLogoutJson {
  event: 'logout';
}

export interface NotificationEventNewJson {
  data: NotificationJson;
  event: 'new';
}

export interface NotificationEventReadJson {
  data: {
    notifications: NotificationIdentityJson[],
    read_count: number,
  };
  event: 'read';
}

export interface NotificationEventVerifiedJson {
  event: 'verified';
}

export class NotificationEventMoreLoaded extends DispatcherAction {
  constructor(readonly data: NotificationBundleJson, readonly context: NotificationContextData) {
    super();
  }
}

export class NotificationEventNew extends DispatcherAction {
  constructor(readonly data: NotificationJson) {
    super();
  }
}

export class NotificationEventRead extends DispatcherAction {
  constructor(readonly data: NotificationIdentity[], readonly readCount: number) {
    super();
  }

  static fromJson(eventData: NotificationEventReadJson): NotificationEventRead {
    const data = eventData.data.notifications.map((json) => fromJson(json));
    return new NotificationEventRead(data, eventData.data.read_count);
  }
}
