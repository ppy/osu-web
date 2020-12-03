// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { UserLogoutAction } from 'actions/user-login-actions';
import { dispatch } from 'app-dispatcher';
import TimeoutCollection from 'interfaces/timeout-collection';
import XHRCollection from 'interfaces/xhr-collection';
import XHRLoadingStateCollection from 'interfaces/xhr-loading-state-collection';
import { route } from 'laroute';
import { forEach, random } from 'lodash';
import { action, computed, observable, observe } from 'mobx';
import { NotificationEventLogoutJson, NotificationEventVerifiedJson } from 'notifications/notification-events';
import SocketMessageEvent from 'socket-message-event';

const isNotificationEventLogoutJson = (arg: any): arg is NotificationEventLogoutJson => {
  return arg.event === 'logout';
};

const isNotificationEventVerifiedJson = (arg: any): arg is NotificationEventVerifiedJson => {
  return arg.event === 'verified';
};

interface NotificationFeedMetaJson {
  url: string;
}

type ConnectionStatus = 'disconnected' | 'disconnecting' | 'connecting' | 'connected';

export default class SocketWorker {
  @observable connectionStatus: ConnectionStatus = 'disconnected';
  userId: number | null = null;
  @observable private active: boolean = false;
  private endpoint?: string;
  private timeout: TimeoutCollection = {};
  private ws: WebSocket | null | undefined;
  private xhr: XHRCollection = {};
  @observable private xhrLoadingState: XHRLoadingStateCollection = {};

  @computed
  get isConnected() {
    return this.connectionStatus === 'connected';
  }

  @computed
  get status() {
    return this.connectionStatus;
  }

  constructor() {
    observe(this, 'connectionStatus', (change) => {
      console.debug(change);
    });
  }

  boot() {
    this.active = this.userId != null;

    if (this.active) {
      this.startWebSocket();
    }
  }

  @action
  setUserId(id: number | null) {
    if (id === this.userId) {
      return;
    }

    if (this.active) {
      this.destroy();
    }

    this.userId = id;
    this.boot();
  }

  @action
  private connectWebSocket() {
    if (!this.active || this.endpoint == null || this.ws != null) {
      return;
    }

    this.connectionStatus = 'connecting';
    Timeout.clear(this.timeout.connectWebSocket);

    const tokenEl = document.querySelector('meta[name=csrf-token]');

    if (tokenEl == null) {
      return;
    }

    const token = tokenEl.getAttribute('content');
    this.ws = new WebSocket(`${this.endpoint}?csrf=${token}`);
    this.ws.addEventListener('open', () => {
      this.connectionStatus = 'connected';
    });
    this.ws.addEventListener('close', this.reconnectWebSocket);
    this.ws.addEventListener('message', this.handleNewEvent);
  }

  @action
  private destroy() {
    this.connectionStatus = 'disconnecting';

    this.userId = null;
    this.active = false;
    forEach(this.xhr, (xhr) => xhr.abort());
    forEach(this.timeout, (timeout) => Timeout.clear(timeout));

    if (this.ws != null) {
      this.ws.close();
      this.ws = null;
    }

    this.connectionStatus = 'disconnected';
  }

  @action
  private handleNewEvent = (event: MessageEvent) => {
    let eventData: any;
    try {
      eventData = JSON.parse(event.data);
    } catch {
      console.debug('Failed parsing data:', event.data);

      return;
    }

    if (isNotificationEventLogoutJson(eventData)) {
      this.destroy();
      dispatch(new UserLogoutAction());
    } else if (isNotificationEventVerifiedJson(eventData)) {
      $.publish('user-verification:success');
    } else {
      dispatch(new SocketMessageEvent(eventData));
    }
  }

  @action
  private reconnectWebSocket = () => {
    this.connectionStatus = 'disconnected';
    if (!this.active) {
      return;
    }

    this.timeout.connectWebSocket = Timeout.set(random(5000, 20000), action(() => {
      this.ws = null;
      this.connectWebSocket();
    }));
  }
  @action
  private startWebSocket = () => {
    if (this.endpoint != null) {
      return this.connectWebSocket();
    }

    if (this.xhrLoadingState.startWebSocket) {
      return;
    }

    Timeout.clear(this.timeout.startWebSocket);

    this.xhrLoadingState.startWebSocket = true;

    return this.xhr.startWebSocket = $.get(route('notifications.endpoint'))
      .done(action((data: NotificationFeedMetaJson) => {
        this.xhrLoadingState.startWebSocket = false;
        this.endpoint = data.url;
        this.connectWebSocket();
      })).fail(action(() => {
        this.timeout.startWebSocket = Timeout.set(10000, this.startWebSocket);
      }));
  }
}
