// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { dispatch } from 'app-dispatcher';
import { NotificationBundleJson } from 'interfaces/notification-json';
import { route } from 'laroute';
import { debounce } from 'lodash';
import { action, makeObservable } from 'mobx';
import Notification from 'models/notification';
import { NotificationContextData } from 'notifications-context';
import NotificationDeletable from 'notifications/notification-deletable';
import { NotificationIdentity, resolveIdentityType, toJson, toString } from 'notifications/notification-identity';
import NotificationReadable from 'notifications/notification-readable';
import { NotificationCursor } from './notification-cursor';
import { NotificationEventDelete, NotificationEventMoreLoaded, NotificationEventRead } from './notification-events';

// I don't know what to name this
export class NotificationResolver {
  private debouncedDeleteByIds = debounce(this.deleteByIds, 500);
  private debouncedSendQueuedMarkedAsRead = debounce(this.sendQueuedMarkedAsRead, 500);
  private deleteByIdsQueue = new Map<number, Notification>();
  private queuedMarkedAsRead = new Map<number, Notification>();
  private queuedMarkedAsReadIdentities = new Map<string, NotificationReadable>();

  constructor() {
    makeObservable(this);
  }

  @action
  delete(deletable: NotificationDeletable) {
    deletable.isDeleting = true;

    // single notifications are batched, also it's annoying if they get removed
    // from display while the user is clicking.
    if (deletable instanceof Notification) {
      this.deleteByIdsQueue.set(deletable.id, deletable);

      this.debouncedDeleteByIds();
      return;
    }

    $.ajax({
      data: { identities: [toJson(deletable.identity)] },
      dataType: 'json',
      method: 'DELETE',
      url: route('notifications.index'),
    })
      .then(action(() => {
        dispatch(new NotificationEventDelete([deletable.identity], 0));
      }))
      .catch(osu.ajaxError)
      .always(action(() => deletable.isDeleting = false));
  }

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

    const identity = readable.identity;

    if (resolveIdentityType(identity) === 'stack') {
      // stacks can't be queued because we need the read counts in the broadcasted websocket event to be separate.
      this.sendMarkAsReadRequest({ identities: [toJson(readable.identity)] })
        .then(action(() => {
          dispatch(new NotificationEventRead([identity], 0));
        }))
        .always(action(() => readable.isMarkingAsRead = false));

      return;
    }

    // single notifications are batched, also it's annoying if they get removed
    // from display while the user is clicking.
    // types are also batched because of they're now called separately.
    if (readable instanceof Notification && readable.canMarkRead) {
      this.queuedMarkedAsRead.set(readable.id, readable);
    } else {
      this.queuedMarkedAsReadIdentities.set(toString(identity), readable);
    }

    this.debouncedSendQueuedMarkedAsRead();
  }

  private deleteByIds() {
    if (this.deleteByIdsQueue.size === 0) return;

    const notifications = [...this.deleteByIdsQueue.values()];
    const identities = notifications.map((notification) => notification.identity);
    this.deleteByIdsQueue.clear();

    $.ajax({
      data: { notifications: identities.map(toJson) },
      dataType: 'json',
      method: 'DELETE',
      url: route('notifications.index'),
    })
      .then(action(() => {
        dispatch(new NotificationEventDelete(identities, 0));
      }))
      .always(action(() => notifications.forEach((notification) => notification.isDeleting = false)));
  }

  private sendMarkAsReadRequest(data: any) {
    return $.ajax({
      data,
      dataType: 'json',
      method: 'POST',
      url: route('notifications.mark-read'),
    })
      .catch(osu.ajaxError);
  }

  private sendQueuedMarkedAsRead() {
    // TODO: combine both sets?
    if (this.queuedMarkedAsRead.size > 0) {
      const queuedItems = [...this.queuedMarkedAsRead.values()];
      const identities = queuedItems.map((notification) => notification.identity);
      this.queuedMarkedAsRead.clear();

      this.sendMarkAsReadRequest({ notifications: identities.map(toJson) })
        .then(action(() => {
          dispatch(new NotificationEventRead(identities, 0));
        }))
        .always(action(() => queuedItems.forEach((notification) => notification.isMarkingAsRead = false)));
    }

    if (this.queuedMarkedAsReadIdentities.size > 0) {
      const notifications = [...this.queuedMarkedAsReadIdentities.values()];
      const identities = notifications.map((notification) => notification.identity);
      this.queuedMarkedAsReadIdentities.clear();

      this.sendMarkAsReadRequest({ identities: identities.map(toJson) })
        .then(action(() => {
          dispatch(new NotificationEventRead(identities, 0));
        }))
        .always(action(() => notifications.forEach((notification) => notification.isMarkingAsRead = false)));
    }
  }
}
