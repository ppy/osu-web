// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { dispatch } from 'app-dispatcher';
import { NotificationBundleJson } from 'interfaces/notification-json';
import XHRCollection from 'interfaces/xhr-collection';
import { route } from 'laroute';
import { forEach, random } from 'lodash';
import { action, computed, observable } from 'mobx';
import core from 'osu-core-singleton';
import {
  NotificationEventDelete,
  NotificationEventDeleteJson,
  NotificationEventLogoutJson,
  NotificationEventMoreLoaded,
  NotificationEventNew,
  NotificationEventNewJson,
  NotificationEventRead,
  NotificationEventReadJson,
  NotificationEventVerifiedJson,
} from './notification-events';

interface NotificationBootJson extends NotificationBundleJson {
  notification_endpoint: string;
}

interface NotificationFeedMetaJson {
  url: string;
}

interface TimeoutCollection {
  [key: string]: number;
}

interface XHRLoadingStateCollection {
  [key: string]: boolean;
}

const isNotificationEventDeleteJson = (arg: any): arg is NotificationEventDeleteJson => {
  return arg.event === 'delete';
};

const isNotificationEventLogoutJson = (arg: any): arg is NotificationEventLogoutJson => {
  return arg.event === 'logout';
};

const isNotificationEventNewJson = (arg: any): arg is NotificationEventNewJson => {
  return arg.event === 'new';
};

const isNotificationEventReadJson = (arg: any): arg is NotificationEventReadJson => {
  return arg.event === 'read';
};

const isNotificationEventVerifiedJson = (arg: any): arg is NotificationEventVerifiedJson => {
  return arg.event === 'verified';
};

export default class Worker {
  @observable hasData: boolean = false;
  @observable hasMore: boolean = true;
  userId: number | null = null;
  @observable private active: boolean = false;
  private endpoint?: string;
  private firstLoadedAt?: Date;
  private readonly store = core.dataStore.notificationStore.unreadStacks;
  private timeout: TimeoutCollection = {};
  private ws: WebSocket | null | undefined;
  private xhr: XHRCollection = {};
  @observable private xhrLoadingState: XHRLoadingStateCollection = {};

  @computed get loadingMore() {
    return this.isPendingXhr('loadMore');
  }

  @computed get refreshing() {
    return this.isPendingXhr('refresh');
  }

  @computed get unreadCount() {
    return this.store.totalWithPm;
  }

  boot = () => {
    this.active = this.userId != null;

    if (this.active) {
      this.startWebSocket();
    }
  }

  @action connectWebSocket = () => {
    if (!this.active || this.endpoint == null || this.ws != null) {
      return;
    }

    Timeout.clear(this.timeout.connectWebSocket);

    const tokenEl = document.querySelector('meta[name=csrf-token]');

    if (tokenEl == null) {
      return;
    }

    const token = tokenEl.getAttribute('content');
    this.ws = new WebSocket(`${this.endpoint}?csrf=${token}`);
    this.ws.addEventListener('open', () => {
      if (this.hasData) {
        this.refresh();
      } else {
        this.loadMore();
      }
    });
    this.ws.addEventListener('close', this.reconnectWebSocket);
    this.ws.addEventListener('message', this.handleNewEvent);
  }

  @action delayedRetryInitialLoadMore = () => {
    if (!this.active || this.hasData) {
      return;
    }

    this.timeout.loadMore = Timeout.set(10000, this.loadMore);
  }

  @action destroy = () => {
    this.userId = null;
    this.active = false;
    this.hasData = false;
    this.store.flushStore();
    forEach(this.xhr, (xhr) => xhr.abort());
    forEach(this.timeout, (timeout) => Timeout.clear(timeout));

    if (this.ws != null) {
      this.ws.close();
      this.ws = null;
    }
  }

  @action handleNewEvent = (event: MessageEvent) => {
    let eventData: any;

    try {
      eventData = JSON.parse(event.data);
    } catch {
      console.debug('Failed parsing data:', event.data);

      return;
    }

    if (isNotificationEventDeleteJson(eventData)) {
      // ignore delete events that occured before the bundle is loaded
      const timestamp = new Date(eventData.data.timestamp);
      if (this.firstLoadedAt != null && timestamp > this.firstLoadedAt) {
        dispatch(NotificationEventDelete.fromJson(eventData));
      }
    } else if (isNotificationEventLogoutJson(eventData)) {
      this.destroy();
    } else if (isNotificationEventNewJson(eventData)) {
      dispatch(new NotificationEventNew(eventData.data));
    } else if (isNotificationEventReadJson(eventData)) {
      // ignore read events that occured before the bundle is loaded
      const timestamp = new Date(eventData.data.timestamp);
      if (this.firstLoadedAt != null && timestamp > this.firstLoadedAt) {
        dispatch(NotificationEventRead.fromJson(eventData));
      }
    } else if (isNotificationEventVerifiedJson(eventData)) {
      if (!this.hasData) {
        this.loadMore();
      }
      $.publish('user-verification:success');
    }
  }

  isActive = () => {
    return this.active;
  }

  @action loadBundle = (data: NotificationBootJson) => {
    dispatch(new NotificationEventMoreLoaded(data, { isWidget: true }));
    this.hasData = true;
    if (this.firstLoadedAt == null) {
      this.firstLoadedAt = new Date(data.timestamp);
    }
  }

  @action loadMore = () => {
    if (!this.active || !this.hasMore || this.isPendingXhr('loadMore')) {
      return;
    }

    Timeout.clear(this.timeout.loadMore);

    this.xhrLoadingState.loadMore = true;

    this.xhr.loadMore = $.ajax({ url: route('notifications.index', { unread: 1 }), dataType: 'json' })
      .always(action(() => {
        this.xhrLoadingState.loadMore = false;
      })).done(this.loadBundle)
      .fail(action((xhr: any) => {
        if (xhr.responseJSON != null && xhr.responseJSON.error === 'verification') {
          return;
        }
        this.delayedRetryInitialLoadMore();
      }));
  }

  @action reconnectWebSocket = () => {
    if (!this.active) {
      return;
    }

    this.timeout.connectWebSocket = Timeout.set(random(5000, 20000), action(() => {
      this.ws = null;
      this.connectWebSocket();
    }));
  }

  @action refresh = () => {
    // TODO: implement updating existing (and newer?) notifications.
  }

  @action setUserId = (id: number | null) => {
    if (id === this.userId) {
      return;
    }

    if (this.active) {
      this.destroy();
    }

    this.userId = id;
    this.boot();
  }

  @action startWebSocket = () => {
    if (this.endpoint != null) {
      return this.connectWebSocket();
    }

    if (this.isPendingXhr('startWebSocket')) {
      return;
    }

    Timeout.clear(this.timeout.startWebSocket);

    return this.xhr.startWebSocket = $.get(route('notifications.endpoint'))
      .done(action((data: NotificationFeedMetaJson) => {
        this.endpoint = data.url;
        this.connectWebSocket();
      })).fail(action(() => {
        this.timeout.startWebSocket = Timeout.set(10000, this.startWebSocket);
      }));
  }

  private isPendingXhr = (id: string) => {
    return this.xhrLoadingState[id] === true;
  }
}
