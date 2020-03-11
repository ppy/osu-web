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

import { dispatch } from 'app-dispatcher';
import { NotificationBundleJson } from 'interfaces/notification-json';
import { route } from 'laroute';
import { debounce } from 'lodash';
import { action } from 'mobx';
import Notification from 'models/notification';
import { NotificationContextData } from 'notifications-context';
import { NotificationIdentity, toJson } from 'notifications/notification-identity';
import NotificationReadable from 'notifications/notification-readable';
import { NotificationCursor } from './notification-cursor';
import { NotificationEventMoreLoaded, NotificationEventRead } from './notification-events';

// I don't know what to name this
export class NotificationResolver {
  private debouncedSendQueuedMarkedAsRead = debounce(this.sendQueuedMarkedAsRead, 500);
  private queuedMarkedAsRead = new Map<number, Notification>();

  @action
  loadMore(identity: NotificationIdentity, context: NotificationContextData, cursor?: NotificationCursor) {
    const urlParams = toJson(identity);
    delete urlParams.id; // ziggy doesn't set the query string if id property exists.

    const url = route('notifications.index', urlParams);

    const params = {
      data: { cursor, unread: context.isWidget },
      dataType: 'json',
      url,
    };

    return $.ajax(params).then((response: NotificationBundleJson) => {
      dispatch(new NotificationEventMoreLoaded(response, context));
    });
  }

  @action
  queueMarkAsRead(readable: NotificationReadable) {
    readable.isMarkingAsRead = true;

    // single notifications are batched, also it's annoying if they get removed
    // from display while the user is clicking.
    if (readable instanceof Notification) {
      if (readable.canMarkRead) {
        this.queuedMarkedAsRead.set(readable.id, readable);
      }

      this.debouncedSendQueuedMarkedAsRead();
      return;
    }

    $.ajax({
      data: toJson(readable.identity),
      dataType: 'json',
      method: 'POST',
      url: route('notifications.mark-read'),
    })
    .then(action(() => {
      dispatch(new NotificationEventRead([readable.identity], 0));
    }))
    .always(action(() => readable.isMarkingAsRead = false));
  }

  private sendQueuedMarkedAsRead() {
    if (this.queuedMarkedAsRead.size === 0) return;

    const notifications = [...this.queuedMarkedAsRead.values()];
    const identities = notifications.map((notification) => notification.identity);
    this.queuedMarkedAsRead.clear();

    $.ajax({
      data: { notifications: identities.map(toJson) },
      dataType: 'json',
      method: 'POST',
      url: route('notifications.mark-read'),
    })
    .then(action(() => {
      dispatch(new NotificationEventRead(identities, 0));
    }))
    .always(action(() => notifications.forEach((notification) => notification.isMarkingAsRead = false)));
  }
}
