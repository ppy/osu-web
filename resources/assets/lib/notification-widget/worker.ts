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

import { NotificationBundleJson } from 'interfaces/notification-bundle-json';
import NotificationJson from 'interfaces/notification-json';
import XHRCollection from 'interfaces/xhr-collection';
import { route } from 'laroute';
import { forEach, minBy, random } from 'lodash';
import { action, computed, observable } from 'mobx';
import core from 'osu-core-singleton';

interface NotificationBootJson extends NotificationBundleJson {
  notification_endpoint: string;
  unread_count: number;
}

interface NotificationEventLogoutJson {
  event: 'logout';
}

interface NotificationEventNewJson {
  data: NotificationJson;
  event: 'new';
}

interface NotificationEventReadJson {
  data: NotificationReadJson;
  event: 'read';
}

interface NotificationEventVerifiedJson {
  event: 'verified';
}

interface NotificationFeedMetaJson {
  url: string;
}

interface NotificationReadJson {
  ids: number[];
}

interface TimeoutCollection {
  [key: string]: number;
}

interface XHRLoadingStateCollection {
  [key: string]: boolean;
}

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
  private readonly notificationStore = core.dataStore.notificationStore;
  private readonly store = core.dataStore.notificationStore.unreadStacks;
  private timeout: TimeoutCollection = {};
  private ws: WebSocket | null | undefined;
  private xhr: XHRCollection = {};
  @observable private xhrLoadingState: XHRLoadingStateCollection = {};

  @computed get loadingMore() {
    return this.isPendingXhr('loadMore');
  }

  @computed get minLoadedId() {
    return null;
    let ret: null | number = null;

    store.notifications.forEach((item) => {
      if (item.id > 0 && (ret == null || item.id < ret)) {
        ret = item.id;
      }
    });

    return ret;
  }

  @computed get refreshing() {
    return this.isPendingXhr('refresh');
  }

  @computed get unreadCount() {
    let ret = this.notificationStore.unreadCount;

    if (typeof this.notificationStore.pmNotification.details === 'object'
      && typeof this.notificationStore.pmNotification.details.count === 'number'
      && this.notificationStore.pmNotification.details.count > 0
    ) {
      ret++;
    }

    return Math.max(ret, 0);
  }

  boot = () => {
    this.active = this.userId != null;

    if (this.active) {
      this.updatePmNotification();
      this.startWebSocket();
      $(document).on('turbolinks:load', this.updatePmNotification);
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
    this.active = false;
    this.hasData = false;
    this.store.flushStore();
    forEach(this.xhr, (xhr) => xhr.abort());
    forEach(this.timeout, (timeout) => Timeout.clear(timeout));

    if (this.ws != null) {
      this.ws.close();
      this.ws = null;
    }

    $(document).off('turbolinks:load', this.updatePmNotification);
  }

  @action handleNewEvent = (event: MessageEvent) => {
    let data: any;

    try {
      data = JSON.parse(event.data);
    } catch {
      console.debug('Failed parsing data:', event.data);

      return;
    }

    if (isNotificationEventLogoutJson(data)) {
      this.destroy();
    } else if (isNotificationEventNewJson(data)) {
      this.notificationStore.updateWithJson(data.data);
      this.notificationStore.unreadCount++;
    } else if (isNotificationEventReadJson(data)) {
      this.markRead(data.data.ids);
    } else if (isNotificationEventVerifiedJson(data)) {
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
    this.store.updateWithBundle(data);
    this.notificationStore.unreadCount = data.unread_count;
    this.hasData = true;
  }

  @action loadMore = () => {
    if (!this.active || !this.hasMore || this.isPendingXhr('loadMore')) {
      return;
    }

    Timeout.clear(this.timeout.loadMore);

    const minLoadedId = this.minLoadedId;
    const params = minLoadedId == null ? null : { max_id: minLoadedId - 1 };

    this.xhrLoadingState.loadMore = true;

    this.xhr.loadMore = $.ajax({ url: route('notifications.unread', params), dataType: 'json' })
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

  @action markRead = (ids: number[]) => {
    this.notificationStore.updateMarkedAsRead(ids);
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

  @action refresh = (maxId?: number) => {
    // TODO: implement updating existing (and newer?) notifications.
  }

  @action setUserId = (id: number | null) => {
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

  @action updateFromServer = (json: NotificationJson) => {
    return this.notificationStore.updateWithJson(json);
  }

  @action updatePmNotification = () => {
    let count = currentUser.unread_pm_count;

    if (count == null) {
      count = 0;
    }

    this.notificationStore.pmNotification.details.count = count;
  }

  private isPendingXhr = (id: string) => {
    return this.xhrLoadingState[id] === true;
  }
}
