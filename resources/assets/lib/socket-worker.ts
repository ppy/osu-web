// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { dispatch } from 'app-dispatcher';
import { route } from 'laroute';
import { forEach, random } from 'lodash';
import { action, computed, observable } from 'mobx';
import { NotificationEventLogoutJson, NotificationEventVerifiedJson } from 'notifications/notification-events';
import core from 'osu-core-singleton';
import SocketMessageEvent from 'socket-message-event';

const isNotificationEventLogoutJson = (arg: any): arg is NotificationEventLogoutJson => arg.event === 'logout';

const isNotificationEventVerifiedJson = (arg: any): arg is NotificationEventVerifiedJson => arg.event === 'verified';

interface NotificationFeedMetaJson {
  url: string;
}

type ConnectionStatus = 'disconnected' | 'disconnecting' | 'connecting' | 'connected';

export default class SocketWorker {
  @observable connectionStatus: ConnectionStatus = 'disconnected';
  @observable hasConnectedOnce = false;
  userId: number | null = null;
  @observable private active = false;
  private endpoint?: string;
  private timeout: Partial<Record<string, number>> = {};
  private ws: WebSocket | null | undefined;
  private xhr: Partial<Record<string, JQueryXHR>> = {};
  private xhrLoadingState: Partial<Record<string, boolean>> = {};

  @computed
  get isConnected() {
    return this.connectionStatus === 'connected';
  }

  boot() {
    this.active = this.userId != null;

    if (this.active) {
      this.startWebSocket();
    }
  }

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
    window.clearTimeout(this.timeout.connectWebSocket);

    const tokenEl = document.querySelector('meta[name=csrf-token]');

    if (tokenEl == null) {
      return;
    }

    const token = tokenEl.getAttribute('content');
    this.ws = new WebSocket(`${this.endpoint}?csrf=${token}`);
    this.ws.addEventListener('open', () => {
      this.connectionStatus = 'connected';
      this.hasConnectedOnce = true;
    });
    this.ws.addEventListener('close', this.reconnectWebSocket);
    this.ws.addEventListener('message', this.handleNewEvent);
  }

  @action
  private destroy() {
    this.connectionStatus = 'disconnecting';

    this.userId = null;
    this.active = false;
    forEach(this.xhr, (xhr) => xhr?.abort());
    forEach(this.timeout, (timeout) => window.clearTimeout(timeout));

    if (this.ws != null) {
      this.ws.close();
      this.ws = null;
    }

    this.connectionStatus = 'disconnected';
  }

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
      core.userLoginObserver.logout();
    } else if (isNotificationEventVerifiedJson(eventData)) {
      $.publish('user-verification:success');
    } else {
      dispatch(new SocketMessageEvent(eventData));
    }
  };

  @action
  private reconnectWebSocket = () => {
    this.connectionStatus = 'disconnected';
    if (!this.active) {
      return;
    }

    this.timeout.connectWebSocket = window.setTimeout(action(() => {
      this.ws = null;
      this.connectWebSocket();
    }), random(5000, 20000));
  };

  private startWebSocket = () => {
    if (this.endpoint != null) {
      return this.connectWebSocket();
    }

    if (this.xhrLoadingState.startWebSocket) {
      return;
    }

    window.clearTimeout(this.timeout.startWebSocket);

    this.xhrLoadingState.startWebSocket = true;

    return this.xhr.startWebSocket = $.get(route('notifications.endpoint'))
      .done(action((data: NotificationFeedMetaJson) => {
        this.xhrLoadingState.startWebSocket = false;
        this.endpoint = data.url;
        this.connectWebSocket();
      })).fail(action(() => {
        this.timeout.startWebSocket = window.setTimeout(this.startWebSocket, 10000);
      }));
  };
}
