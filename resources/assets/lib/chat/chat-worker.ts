// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DispatcherAction from 'actions/dispatcher-action';
import { WindowBlurAction, WindowFocusAction } from 'actions/window-focus-actions';
import { dispatch, dispatchListener } from 'app-dispatcher';
import ChatApi from 'chat/chat-api';
import { ChatChannelJoinEvent, ChatChannelPartEvent, ChatMessageNewEvent, isChannelEvent, isMessageEvent } from 'chat/chat-events';
import DispatchListener from 'dispatch-listener';
import { maxBy } from 'lodash';
import { observe, transaction } from 'mobx';
import Channel from 'models/chat/channel';
import Message from 'models/chat/message';
import SocketMessageEvent, { SocketEventData } from 'socket-message-event';
import SocketWorker from 'socket-worker';
import ChannelStore from 'stores/channel-store';
import RetryDelay from 'utils/retry-delay';

function newDispatchActionFromJson(json: SocketEventData) {
  if (isMessageEvent(json)) {
    switch (json.event) {
      case 'chat.message.new':
        return new ChatMessageNewEvent(Message.fromJson(json.data));
    }
  } else if (isChannelEvent(json)) {
    switch (json.event) {
      case 'chat.channel.join': {
        const channel = new Channel(json.data.channel_id);
        channel.updateWithJson(json.data);
        return new ChatChannelJoinEvent(channel);
      }
      case 'chat.channel.part':
        return new ChatChannelPartEvent(json.data.channel_id);
    }
  }
}

@dispatchListener
export default class ChatWorker implements DispatchListener {
  private lastHistoryId: number | null = null;
  private pollTime = 1000;
  private pollTimeIdle = 5000;
  private pollingEnabled = false;
  private retryDelay = new RetryDelay();
  private updateTimerId?: number;
  private updateXHR = false;
  private windowIsActive = true;

  constructor(private socketWorker: SocketWorker, private channelStore: ChannelStore) {
    observe(this.socketWorker, 'isConnected', (change) => {
      if (change.newValue && change.newValue !== change.oldValue) {
        this.channelStore.channels.forEach((channel) => channel.needsRefresh = true);
      }
    }, true);
  }

  handleDispatchAction(event: DispatcherAction) {
    if (event instanceof WindowFocusAction) {
      this.windowIsActive = true;
    } else if (event instanceof WindowBlurAction) {
      this.windowIsActive = false;
    }

    if (!(event instanceof SocketMessageEvent)) return;

    const dispatchAction = newDispatchActionFromJson(event.message);
    if (dispatchAction != null) {
      dispatch(dispatchAction);
    }
  }

  pollForUpdates = () => {
    if (this.updateXHR) {
      return;
    }

    this.updateXHR = true;

    ChatApi.getUpdates(this.channelStore.lastPolledMessageId, this.lastHistoryId)
      .then((updateJson) => {
        this.retryDelay.reset();
        this.updateXHR = false;
        if (this.pollingEnabled) {
          this.updateTimerId = window.setTimeout(this.pollForUpdates, this.pollingTime());
        }

        if (!updateJson) {
          return;
        }

        transaction(() => {
          const newHistoryId = maxBy(updateJson.silences, 'id')?.id;

          if (newHistoryId != null) {
            this.lastHistoryId = newHistoryId;
          }

          this.channelStore.updateWithJson(updateJson);
        });
      })
      .catch((err) => {
        // silently ignore errors and continue polling
        this.updateXHR = false;
        if (this.pollingEnabled) {
          this.updateTimerId = window.setTimeout(this.pollForUpdates, this.retryDelay.get());
        }
      });
  };

  pollingTime(): number {
    return this.windowIsActive ? this.pollTime : this.pollTimeIdle;
  }

  startPolling() {
    if (!this.updateTimerId) {
      this.updateTimerId = window.setTimeout(this.pollForUpdates, this.pollingTime());
    }
  }

  stopPolling() {
    if (this.updateTimerId) {
      window.clearTimeout(this.updateTimerId);
      this.updateTimerId = undefined;
      this.updateXHR = false;
    }
  }
}
