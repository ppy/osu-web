// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DispatcherAction from 'actions/dispatcher-action';
import { dispatch, dispatchListener } from 'app-dispatcher';
import DispatchListener from 'dispatch-listener';
import { NotificationBundleJson } from 'interfaces/notification-json';
import { route } from 'laroute';
import { action, computed, observable, observe } from 'mobx';
import SocketMessageEvent, { SocketEventData } from 'socket-message-event';
import SocketWorker from 'socket-worker';
import ConnectionDelay from 'utils/connection-delay';
import {
  NotificationEventDelete,
  NotificationEventDeleteJson,
  NotificationEventMoreLoaded,
  NotificationEventNew,
  NotificationEventNewJson,
  NotificationEventRead,
  NotificationEventReadJson,
} from './notification-events';

interface NotificationBootJson extends NotificationBundleJson {
  notification_endpoint: string;
}

const isNotificationEventDeleteJson = (arg: SocketEventData): arg is NotificationEventDeleteJson => arg.event === 'delete';

const isNotificationEventNewJson = (arg: SocketEventData): arg is NotificationEventNewJson => arg.event === 'new';

const isNotificationEventReadJson = (arg: SocketEventData): arg is NotificationEventReadJson => arg.event === 'read';

/**
 * Handles initial notifications bootstrapping and parsing of web socket messages into notification events.
 */
@dispatchListener
export default class Worker implements DispatchListener {
  @observable waitingVerification = false;

  private connectionDelay = new ConnectionDelay();
  @observable private firstLoadedAt?: Date;
  private timeout: Partial<Record<string, number>> = {};
  private xhr: Partial<Record<string, JQueryXHR>> = {};
  private xhrLoadingState: Partial<Record<string, boolean>> = {};

  @computed
  get hasData() {
    return this.firstLoadedAt != null;
  }

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
    this.timeout.loadMore = window.setTimeout(this.loadMore, this.connectionDelay.get());
  }

  @action
  private loadBundle(data: NotificationBootJson) {
    dispatch(new NotificationEventMoreLoaded(data, { isWidget: true }));
    if (this.firstLoadedAt == null) {
      this.firstLoadedAt = new Date(data.timestamp);
    }
  }

  private loadMore = () => {
    if (this.xhrLoadingState.loadMore) {
      return;
    }

    window.clearTimeout(this.timeout.loadMore);

    this.xhrLoadingState.loadMore = true;

    this.xhr.loadMore = $.ajax({ dataType: 'json', url: route('notifications.index', { unread: 1 }) })
      .always(() => {
        this.xhrLoadingState.loadMore = false;
      }).done((data: NotificationBootJson) => {
        this.waitingVerification = false;
        this.loadBundle(data);
        this.connectionDelay.reset();
      })
      .fail((xhr) => {
        if (xhr.responseJSON != null && xhr.responseJSON.error === 'verification') {
          this.waitingVerification = true;

          return;
        }
        // Non-verification 401 error means user has been logged out. Don't retry.
        if (xhr.status === 401) {
          return;
        }
        this.delayedRetryInitialLoadMore();
      });
  };
}
