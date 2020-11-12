// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { dispatch } from 'app-dispatcher';
import { NotificationBundleJson } from 'interfaces/notification-json';
import { route } from 'laroute';
import { debounce } from 'lodash';
import { action } from 'mobx';
import Notification from 'models/notification';
import { NotificationContextData } from 'notifications-context';
import NotificationDeletable from 'notifications/notification-deletable';
import { NotificationIdentity, toJson, toString } from 'notifications/notification-identity';
import NotificationReadable from 'notifications/notification-readable';
import { NotificationCursor } from './notification-cursor';
import { NotificationEventDelete, NotificationEventMoreLoaded, NotificationEventRead } from './notification-events';

// I don't know what to name this
export class NotificationResolver {
  private debouncedDeleteByIds = debounce(this.deleteByIds, 500);
  private debouncedSendQueuedMarkedAsRead = debounce(this.sendQueuedMarkedAsRead, 500);
  private debouncedSendQueuedMarkedAsReadIdentities = debounce(this.sendQueuedMarkedAsReadIdentities, 500);
  private deleteByIdsQueue = new Map<number, Notification>();
  private queuedMarkedAsRead = new Map<number, Notification>();
  private queuedMarkedAsReadIdentities = new Map<string, NotificationReadable>();

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
      data: toJson(deletable.identity),
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

    // single notifications are batched, also it's annoying if they get removed
    // from display while the user is clicking.
    if (readable instanceof Notification) {
      if (readable.canMarkRead) {
        this.queuedMarkedAsRead.set(readable.id, readable);
      }

      this.debouncedSendQueuedMarkedAsRead();
      return;
    }

    this.queuedMarkedAsReadIdentities.set(toString(readable.identity), readable);
    this.debouncedSendQueuedMarkedAsReadIdentities();
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
    .catch(osu.ajaxError)
    .always(action(() => notifications.forEach((notification) => notification.isMarkingAsRead = false)));
  }

  private sendQueuedMarkedAsReadIdentities() {
    if (this.queuedMarkedAsReadIdentities.size === 0) return;

    const notifications = [...this.queuedMarkedAsReadIdentities.values()];
    const identities = notifications.map((notification) => notification.identity);
    this.queuedMarkedAsReadIdentities.clear();

    $.ajax({
      data: { identities: identities.map(toJson) },
      dataType: 'json',
      method: 'POST',
      url: route('notifications.mark-read'),
    })
    .then(action(() => {
      dispatch(new NotificationEventRead(identities, 0));
    }))
    .catch(osu.ajaxError)
    .always(action(() => notifications.forEach((notification) => notification.isMarkingAsRead = false)));
  }
}
