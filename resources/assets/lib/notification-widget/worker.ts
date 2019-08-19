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

import NotificationJson from 'interfaces/notification-json';
import XHRCollection from 'interfaces/xhr-collection';
import { forEach, minBy, orderBy, random } from 'lodash';
import { computed, observable } from 'mobx';
import LegacyPmNotification from 'models/legacy-pm-notification';
import Notification from 'models/notification';

interface NotificationBundleJson {
  has_more: boolean;
  notification_endpoint: string;
  notifications: NotificationJson[];
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
  @observable actualUnreadCount: number = -1;
  @observable hasData: boolean = false;
  @observable hasMore: boolean = true;
  @observable pmNotification = new LegacyPmNotification();
  userId: number | null = null;
  @observable private active: boolean = false;
  private endpoint?: string;
  @observable private items = observable.map<number, Notification>();
  private refreshing = false;
  private timeout: TimeoutCollection = {};
  private ws: WebSocket | null | undefined;
  private xhr: XHRCollection = {};

  @computed get itemsGroupedByType() {
    const ret: Map<string, Notification[]> = new Map();

    const sortedItems = orderBy([...this.items.values()], ['id'], ['desc']);
    sortedItems.unshift(this.pmNotification);

    sortedItems.forEach((item) => {
      const key = item.displayType;

      if (key == null) {
        return;
      }

      let groupedItems = ret.get(key);

      if (groupedItems == null) {
        groupedItems = [];
        ret.set(key, groupedItems);
      }

      if (item.isRead) {
        return;
      }

      groupedItems.push(item);
    });

    return ret;
  }

  get loadingMore() {
    return this.isPendingXhr('loadMore');
  }

  @computed get minLoadedId() {
    let ret: null | number = null;

    this.items.forEach((item) => {
      if (item.id > 0 && (ret == null || item.id < ret)) {
        ret = item.id;
      }
    });

    return ret;
  }

  @computed get unreadCount() {
    let ret = this.actualUnreadCount;

    if (typeof this.pmNotification.details === 'object'
      && typeof this.pmNotification.details.count === 'number'
      && this.pmNotification.details.count > 0
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

  connectWebSocket = () => {
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

  delayedRetryInitialLoadMore = () => {
    if (!this.active || this.hasData) {
      return;
    }

    this.timeout.loadMore = Timeout.set(10000, this.loadMore);
  }

  destroy = () => {
    this.active = false;
    this.hasData = false;
    this.items = observable.map();
    forEach(this.xhr, (xhr) => xhr.abort());
    forEach(this.timeout, (timeout) => Timeout.clear(timeout));

    if (this.ws != null) {
      this.ws.close();
      this.ws = null;
    }

    $(document).off('turbolinks:load', this.updatePmNotification);
  }

  handleNewEvent = (event: MessageEvent) => {
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
      this.updateFromServer(data.data);
      this.actualUnreadCount++;
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

  loadBundle = (data: NotificationBundleJson) => {
    data.notifications.forEach(this.updateFromServer);
    this.actualUnreadCount = data.unread_count;
    this.hasMore = data.has_more;
    this.hasData = true;
  }

  loadMore = () => {
    if (!this.active || !this.hasMore || this.isPendingXhr('loadMore')) {
      return;
    }

    Timeout.clear(this.timeout.loadMore);

    const minLoadedId = this.minLoadedId;
    const params = minLoadedId == null ? null : { max_id: minLoadedId - 1 };

    this.xhr.loadMore = $.get(laroute.route('notifications.index', params))
      .done(this.loadBundle)
      .fail((xhr) => {
        if (xhr.responseJSON != null && xhr.responseJSON.error === 'verification') {
          return;
        }
        this.delayedRetryInitialLoadMore();
      });
  }

  markRead = (ids: number[]) => {
    for (const id of ids) {
      const item = this.items.get(id);

      if (item == null || !item.isRead) {
        this.actualUnreadCount--;
      }

      if (item != null) {
        item.isRead = true;
      }
    }
  }

  reconnectWebSocket = () => {
    if (!this.active) {
      return;
    }

    this.timeout.connectWebSocket = Timeout.set(random(5000, 20000), () => {
      this.ws = null;
      this.connectWebSocket();
    });
  }

  refresh = (maxId?: number) => {
    if (!this.active || this.refreshing) {
      return;
    }

    this.refreshing = true;

    const params = { with_read: true, max_id: maxId };

    this.xhr.refresh = $.get(laroute.route('notifications.index'), params)
      .always(() => {
        this.refreshing = false;
      }).done((bundleJson: NotificationBundleJson) => {
        const oldestNotification = minBy(bundleJson.notifications, 'id');
        const minLoadedId = this.minLoadedId;

        this.loadBundle(bundleJson);

        if (bundleJson.has_more &&
          oldestNotification != null &&
          minLoadedId != null &&
          oldestNotification.id > minLoadedId
        ) {
          this.refresh(oldestNotification.id - 1);
        }
      });
  }

  sendMarkRead = (ids: number[]) => {
    const key = `sendMarkRead:${ids.join(':')}`;

    if (this.isPendingXhr(key)) {
      return this.xhr[key];
    }

    return this.xhr[key] = $.ajax({
        data: { ids },
        dataType: 'json',
        method: 'POST',
        url: laroute.route('notifications.mark-read'),
    }).done(() => {
      this.markRead(ids);
    });
  }

  setUserId = (id: number | null) => {
    if (this.active) {
      this.destroy();
    }

    this.userId = id;
    this.boot();
  }

  startWebSocket = () => {
    if (this.endpoint != null) {
      return this.connectWebSocket();
    }

    if (this.isPendingXhr('startWebSocket')) {
      return;
    }

    Timeout.clear(this.timeout.startWebSocket);

    return this.xhr.startWebSocket = $.get(laroute.route('notifications.endpoint'))
      .done((data: NotificationFeedMetaJson) => {
        this.endpoint = data.url;
        this.connectWebSocket();
      }).fail(() => {
        this.timeout.startWebSocket = Timeout.set(10000, this.startWebSocket);
      });
  }

  updateFromServer = (json: NotificationJson) => {
    const item = new Notification(json.id);
    item.updateFromJson(json);
    this.items.set(item.id, item);

    return item;
  }

  updatePmNotification = () => {
    let count = currentUser.unread_pm_count;

    if (count == null) {
      count = 0;
    }

    this.pmNotification.details.count = count;
  }

  private isPendingXhr = (id: string) => {
    const xhr = this.xhr[id];

    if (xhr == null) {
      return false;
    } else {
      return xhr.readyState !== 0 && xhr.readyState !== 4;
    }
  }
}
