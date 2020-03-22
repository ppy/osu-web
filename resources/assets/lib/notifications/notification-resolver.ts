// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
