// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DispatcherAction from 'actions/dispatcher-action';
import { UserLogoutAction } from 'actions/user-login-actions';
import { dispatch, dispatchListener } from 'app-dispatcher';
import DispatchListener from 'dispatch-listener';
import { NotificationBundleJson } from 'interfaces/notification-json';
import TimeoutCollection from 'interfaces/timeout-collection';
import XHRCollection from 'interfaces/xhr-collection';
import XHRLoadingStateCollection from 'interfaces/xhr-loading-state-collection';
import { route } from 'laroute';
import { forEach } from 'lodash';
import { observable, observe } from 'mobx';
import SocketMessageEvent from 'socket-message-event';
import SocketWorker from 'socket-worker';
import {
  NotificationEventDelete,
  NotificationEventDeleteJson,
  NotificationEventMoreLoaded,
  NotificationEventNew,
  NotificationEventNewJson,
  NotificationEventRead,
  NotificationEventReadJson,
} from './notification-events';

export interface MessageJson {
  data: JSON;
  event: string;
}

interface NotificationBootJson extends NotificationBundleJson {
  notification_endpoint: string;
}

const isNotificationEventDeleteJson = (arg: any): arg is NotificationEventDeleteJson => {
  return arg.event === 'delete';
};

const isNotificationEventNewJson = (arg: any): arg is NotificationEventNewJson => {
  return arg.event === 'new';
};

const isNotificationEventReadJson = (arg: any): arg is NotificationEventReadJson => {
  return arg.event === 'read';
};

/**
 * Handles initial notifications bootstrapping and parsing of web socket messages into notification events.
 */
@dispatchListener
export default class Worker implements DispatchListener {
  private firstLoadedAt?: Date;
  private timeout: TimeoutCollection = {};
  private xhr: XHRCollection = {};
  private xhrLoadingState: XHRLoadingStateCollection = {};

  constructor(private readonly socketWorker: SocketWorker) {
    observe(this.socketWorker, 'connectionStatus', (change) => {
      if (change.newValue === 'connected') {
        this.loadMore();
      }
    }, true);

    $.subscribe('user-verification:success.notifications-worker', () => {
      this.loadMore();
    });
  }

  handleDispatchAction(event: DispatcherAction) {
    if (event instanceof UserLogoutAction) {
      this.destroy();
    }

    if (!(event instanceof SocketMessageEvent)) return;

    const message = event.message;
    if (isNotificationEventDeleteJson(message)) {
      // ignore delete events that occured before the bundle is loaded
      const timestamp = new Date(message.data.timestamp);
      if (this.firstLoadedAt != null && timestamp > this.firstLoadedAt) {
        dispatch(NotificationEventDelete.fromJson(message));
      }
    } else if (isNotificationEventNewJson(message)) {
      dispatch(new NotificationEventNew(message.data));
    } else if (isNotificationEventReadJson(message)) {
      // ignore read events that occured before the bundle is loaded
      const timestamp = new Date(message.data.timestamp);
      if (this.firstLoadedAt != null && timestamp > this.firstLoadedAt) {
        dispatch(NotificationEventRead.fromJson(message));
      }
    }
  }

  private delayedRetryInitialLoadMore() {
    this.timeout.loadMore = Timeout.set(10000, this.loadMore);
  }

  private destroy() {
    forEach(this.xhr, (xhr) => xhr.abort());
    forEach(this.timeout, (timeout) => Timeout.clear(timeout));
  }

  private loadBundle(data: NotificationBootJson) {
    dispatch(new NotificationEventMoreLoaded(data, { isWidget: true }));
    if (this.firstLoadedAt == null) {
      this.firstLoadedAt = new Date(data.timestamp);
    }
  }

  private loadMore() {
    if (this.xhrLoadingState.loadMore) {
      return;
    }

    Timeout.clear(this.timeout.loadMore);

    this.xhrLoadingState.loadMore = true;

    this.xhr.loadMore = $.ajax({ url: route('notifications.index', { unread: 1 }), dataType: 'json' })
      .always(() => {
        this.xhrLoadingState.loadMore = false;
      }).done((data: NotificationBootJson) => {
        this.loadBundle(data);
      })
      .fail((xhr) => {
        if (xhr.responseJSON != null && xhr.responseJSON.error === 'verification') {
          return;
        }
        this.delayedRetryInitialLoadMore();
      });
  }
}
