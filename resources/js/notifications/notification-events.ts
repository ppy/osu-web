// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

/* eslint-disable max-classes-per-file */

import DispatcherAction from 'actions/dispatcher-action';
import NotificationJson, { NotificationBundleJson } from 'interfaces/notification-json';
import { fromJson, NotificationIdentity, NotificationIdentityJson } from 'notifications/notification-identity';

export interface NotificationEventLogoutJson {
  event: 'logout';
}

export interface NotificationEventNewJson {
  data: NotificationJson;
  event: 'new';
}

export interface NotificationEventDeleteJson {
  data: {
    notifications: NotificationIdentityJson[];
    read_count: number;
    timestamp: string;
  };
  event: 'delete';
}

export interface NotificationEventMoreLoadedContext {
  isWidget: boolean;
}

export interface NotificationEventReadJson {
  data: {
    notifications: NotificationIdentityJson[];
    read_count: number;
    timestamp: string;
  };
  event: 'read';
}

export interface NotificationEventVerifiedJson {
  event: 'verified';
}

export class NotificationEventMoreLoaded extends DispatcherAction {
  constructor(readonly data: NotificationBundleJson, readonly context: NotificationEventMoreLoadedContext) {
    super();
  }
}

export class NotificationEventNew extends DispatcherAction {
  constructor(readonly data: NotificationJson) {
    super();
  }
}

export class NotificationEventDelete extends DispatcherAction {
  constructor(readonly data: NotificationIdentity[], readonly readCount: number) {
    super();
  }

  static fromJson(eventData: NotificationEventDeleteJson): NotificationEventDelete {
    const data = eventData.data.notifications.map((json) => fromJson(json));
    return new NotificationEventDelete(data, eventData.data.read_count);
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
