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

import * as _ from 'lodash';
import {computed, observable} from 'mobx';

interface NotificationItemJSON {
  id: number;
  name: string;
  created_at: string;
  object_type: string;
  object_id: number;
  source_user_id: number;
  details: any;
}

interface NotificationJSON {
  user_notifications: NotificationItemJSON;
  unread_count: number;
}

interface NotificationProps {
  store: NotificationStore;
}

interface XHRCollection {
  [key: string]: JQueryXHR;
}

interface TimeoutCollection {
  [key: string]: number;
}

export default class NotificationStore {
  @observable private userId: number | null;
  @observable public unreadCount: number = -1;
  @observable public hasData: boolean = false;
  private ws?: WebSocket;
  private xhr: XHRCollection = {};
  private timeout: TimeoutCollection = {};

  public constructor(userId: number | null) {
    this.userId = userId;
  }

  public boot = () => {
    this.fetchInitialState();
    this.connectWebSocket();
  }

  public fetchInitialState = () => {
    if (!this.isActive) {
      return;
    }

    if (this.xhr.fetchInitialState != null) {
      this.xhr.fetchInitialState.abort();
    }

    this.xhr.fetchInitialState = $.get(laroute.route('notifications.index'))
      .done((notificationJSON: NotificationJSON) => {
        this.hasData = true;
        this.unreadCount = notificationJSON.unread_count;
      }).fail(() => {
        this.timeout.fetchInitialState = setTimeout(this.fetchInitialState, 10000);
      });
  }

  public connectWebSocket = () => {
    if (!this.isActive) {
      return;
    }

    const tokenEl = document.querySelector('meta[name=csrf-token]');
    if (tokenEl == null) {
      return;
    }

    const token = tokenEl.getAttribute('content');
    let url = process.env.WEBSOCKET_URL;
    if (url == null) {
      const protocol = window.location.protocol === 'https:' ? 'wss:' : 'ws:';
      url = `${protocol}//${window.location.host}/home/notifications/live`;
    }
    this.ws = new WebSocket(`${url}?csrf=${token}`);
    this.ws.onclose = () => this.timeout.connectWebSocket = setTimeout(this.connectWebSocket, 10000);
  }

  public destroy = () => {
    _.forEach(this.xhr, (xhr) => xhr.abort());
    _.forEach(this.timeout, (timeout) => clearTimeout(timeout));

    this.ws!.close();
  }

  @computed public get isActive() {
    return this.userId != null;
  }
}
