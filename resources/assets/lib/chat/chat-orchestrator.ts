// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import {
  ChatChannelLoadEarlierMessages,
  ChatChannelPartAction,
  ChatChannelSwitchAction,
  ChatPresenceUpdateAction,
} from 'actions/chat-actions';
import DispatcherAction from 'actions/dispatcher-action';
import { WindowBlurAction, WindowFocusAction } from 'actions/window-focus-actions';
import { dispatch, dispatchListener } from 'app-dispatcher';
import DispatchListener from 'dispatch-listener';
import { clamp } from 'lodash';
import { transaction } from 'mobx';
import Message from 'models/chat/message';
import RootDataStore from 'stores/root-data-store';
import ChatAPI from './chat-api';
import { MessageJSON } from './chat-api-responses';

@dispatchListener
export default class ChatOrchestrator implements DispatchListener {
  private api: ChatAPI;
  private markingAsRead: Record<number, number> = {};
  private windowIsActive: boolean = true;

  constructor(private rootDataStore: RootDataStore) {
    this.rootDataStore = rootDataStore;
    this.api = new ChatAPI();
  }

  addMessages(channelId: number, messages: MessageJSON[]) {
    const newMessages: Message[] = [];

    transaction(() => {
      messages.forEach((json: MessageJSON) => {
        const newMessage = Message.fromJSON(json);
        newMessages.push(newMessage);
      });

      this.rootDataStore.channelStore.addMessages(channelId, newMessages);
    });
  }

  changeChannel(channelId: number) {
    const uiState = this.rootDataStore.chatState;
    const channelStore = this.rootDataStore.channelStore;

    if (channelId === uiState.selected && !channelStore.getOrCreate(channelId).loaded) {
      return;
    }

    transaction(async () => {
      if (channelStore.getOrCreate(uiState.selected).type !== 'NEW') {
        // don't disable autoScroll if we're 'switching' away from the 'new chat' screen
        //   e.g. keep autoScroll enabled to jump to the newly sent message when restarting an old conversation
        uiState.autoScroll = false;
      }
      const channel = channelStore.getOrCreate(channelId);

      if (!channel.newPmChannel) {
        if (channel.loaded) {
          this.markAsRead(channelId);
        } else {
          await this.loadChannel(channelId);
          if (this.windowIsActive) {
            this.markAsRead(channelId);
          }
        }
      }

      uiState.selected = channelId;
    });
  }

  focusChannelAtIndex(index: number) {
    const channelList = this.rootDataStore.channelStore.channelList;
    if (channelList.length === 0) {
      this.rootDataStore.channelStore.loaded = false;
      return;
    }

    const nextIndex = clamp(index, 0, channelList.length - 1);
    const channel = this.rootDataStore.channelStore.channelList[nextIndex];

    dispatch(new ChatChannelSwitchAction(channel.channelId));
  }

  handleDispatchAction(action: DispatcherAction) {
    if (action instanceof ChatChannelSwitchAction) {
      this.changeChannel(action.channelId);
    } else if (action instanceof ChatChannelLoadEarlierMessages) {
      this.loadChannelEarlierMessages(action.channelId);
    } else if (action instanceof ChatChannelPartAction) {
      this.handleChatChannelPartAction(action);
    } else if (action instanceof ChatMessageAddAction) {
      if (this.windowIsActive && this.rootDataStore.channelStore.loaded) {
        this.markAsRead(this.rootDataStore.chatState.selected);
      }
    } else if (action instanceof ChatPresenceUpdateAction) {
      this.handleChatPresenceUpdateAction();
    } else if (action instanceof WindowFocusAction) {
      this.windowIsActive = true;
      if (this.rootDataStore.channelStore.loaded) {
        this.markAsRead(this.rootDataStore.chatState.selected);
      }
    } else if (action instanceof WindowBlurAction) {
      this.windowIsActive = false;
    }
  }

  async loadChannel(channelId: number) {
    const channel = this.rootDataStore.channelStore.getOrCreate(channelId);

    if (channel.loading) {
      return;
    }

    channel.loading = true;

    try {
      const messages = await this.api.getMessages(channelId);
      transaction(() => {
        this.addMessages(channelId, messages);
        channel.loaded = true;
      });
    } catch (err) {
      console.debug('loadChannel error', err);
    } finally {
      channel.loading = false;
    }
  }

  async loadChannelEarlierMessages(channelId: number) {
    const channel = this.rootDataStore.channelStore.get(channelId);

    if (channel == null || !channel.hasEarlierMessages || channel.loadingEarlierMessages) {
      return;
    }

    channel.loadingEarlierMessages = true;

    try {
      const messages = await this.api.getMessages(channel.channelId, { until: channel.minMessageId });
      this.addMessages(channelId, messages);
    } catch (err) {
      console.debug('loadChannelEarlierMessages error', err);
    } finally {
      channel.loadingEarlierMessages = false;
    }
  }

  markAsRead(channelId: number) {
    if (this.markingAsRead[channelId] != null) {
      return;
    }

    const channel = this.rootDataStore.channelStore.getOrCreate(channelId);

    if (!channel.isUnread) {
      return;
    }

    const currentTimeout = window.setTimeout(async () => {
      // allow next debounce to be queued again
      if (this.markingAsRead[channelId] === currentTimeout) {
        delete this.markingAsRead[channelId];
      }

      const lastReadId = channel.lastMessageId;

      // We don't need to send mark-as-read for our own messages, as the cursor is automatically bumped forward server-side when sending messages.
      const lastSentMessage = channel.messages[channel.messages.length - 1];
      if (lastSentMessage && lastSentMessage.sender.id === window.currentUser.id) {
        channel.lastReadId = lastReadId;

        return;
      }

      try {
        await this.api.markAsRead(channel.channelId, lastReadId);
        channel.lastReadId = lastReadId;
      } catch (err) {
        console.debug('markAsRead error', err);
      }
    }, 1000);

    this.markingAsRead[channelId] = currentTimeout;
  }

  private async handleChatChannelPartAction(action: ChatChannelPartAction) {
    const channelStore = this.rootDataStore.channelStore;
    const channel = channelStore.get(action.channelId);
    const index = channel != null ? channelStore.channelList.indexOf(channel) : null;
    channelStore.partChannel(action.channelId);

    if (this.rootDataStore.chatState.selected === channel?.channelId) {
      this.focusChannelAtIndex(index ?? 0);
    }

    if (action.shouldSync && action.channelId !== -1) {
      try {
        this.api.partChannel(action.channelId, window.currentUser.id);
      } catch (err) {
        console.debug('leaveChannel error', err);
      }
    }
  }

  // ensure a channel is selected if available
  private handleChatPresenceUpdateAction() {
    const channelStore = this.rootDataStore.channelStore;
    const channel = channelStore.get(this.rootDataStore.chatState.selected);
    if (channel == null) {
      this.focusChannelAtIndex(0);
    }
  }
}
