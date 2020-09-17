// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import {
  ChatChannelDeletedAction,
  ChatChannelJoinAction,
  ChatChannelLoadEarlierMessages,
  ChatChannelSwitchAction,
  ChatMessageAddAction,
} from 'actions/chat-actions';
import DispatcherAction from 'actions/dispatcher-action';
import { WindowBlurAction, WindowFocusAction } from 'actions/window-focus-actions';
import { dispatch, dispatchListener } from 'app-dispatcher';
import DispatchListener from 'dispatch-listener';
import { clamp } from 'lodash';
import { transaction } from 'mobx';
import { defaultIcon } from 'models/chat/channel';
import Message from 'models/chat/message';
import RootDataStore from 'stores/root-data-store';
import ChatAPI from './chat-api';
import { MessageJSON } from './chat-api-responses';

@dispatchListener
export default class ChatOrchestrator implements DispatchListener {
  private api = new ChatAPI();
  private markingAsRead: Record<number, number> = {};
  private selectedIndex = 0;
  private windowIsActive: boolean = true;

  constructor(private rootDataStore: RootDataStore) {
  }

  handleDispatchAction(action: DispatcherAction) {
    if (action instanceof ChatChannelDeletedAction) {
      this.handleChatChannelDeletedAction(action);
    } else if (action instanceof ChatChannelSwitchAction) {
      this.handleChatChannelSwitchAction(action.channelId);
    } else if (action instanceof ChatChannelLoadEarlierMessages) {
      this.loadChannelEarlierMessages(action.channelId);
    } else if (action instanceof ChatChannelJoinAction) {
      this.handleChatChannelJoinAction(action);
    } else if (action instanceof ChatMessageAddAction) {
      if (action.message.channelId === this.rootDataStore.uiState.chat.selected) {
        this.markAsRead(this.rootDataStore.uiState.chat.selected);
      }
    } else if (action instanceof WindowFocusAction) {
      this.windowIsActive = true;
      this.markAsRead(this.rootDataStore.uiState.chat.selected);
    } else if (action instanceof WindowBlurAction) {
      this.windowIsActive = false;
    }
  }

  async loadChannel(channelId: number) {
    const channel = this.rootDataStore.channelStore.getOrCreate(channelId);

    if (channel.loading) {
      return Promise.resolve();
    }

    channel.loading = true;
    if (!channel.metaLoaded) {
      console.debug(`loading metadata for channel ${channel.channelId}`);
      const json = await this.api.getChannel(channel.channelId);
      channel.updateWithJson(json);
    }

    if (channel.loaded) {
      return Promise.resolve();
    }

    // FIXME: initial messsages and earlier messages should be rolled up?
    return this.api.getMessages(channelId)
      .then((messages) => {
        transaction(() => {
          this.addMessages(channelId, messages);
          channel.loading = false;
          channel.loaded = true;
        });
      })
      .catch((err) => {
        channel.loading = false;
        console.debug('loadChannel error', err);
      });
  }

  loadChannelEarlierMessages(channelId: number) {
    const channel = this.rootDataStore.channelStore.get(channelId);

    if (channel == null || !channel.hasEarlierMessages || channel.loadingEarlierMessages) {
      return;
    }

    channel.loadingEarlierMessages = true;

    this.api.getMessages(channel.channelId, { until: channel.minMessageId })
      .then((messages) => {
        transaction(() => {
          channel.loadingEarlierMessages = false;
          this.addMessages(channelId, messages);
        });
      }).catch((err) => {
        channel.loadingEarlierMessages = false;
        console.debug('loadChannelEarlierMessages error', err);
      });
  }

  private addMessages(channelId: number, messages: MessageJSON[]) {
    transaction(() => {
      const newMessages = messages.map((json: MessageJSON) => {
        if (json.sender != null) this.rootDataStore.userStore.getOrCreate(json.sender_id, json.sender);
        return Message.fromJSON(json);
      });

      this.rootDataStore.channelStore.addMessages(channelId, newMessages);
    });
  }

  private focusChannelAtIndex(index: number) {
    const channelList = this.rootDataStore.channelStore.channelList;
    if (channelList.length === 0) {
      return;
    }

    const nextIndex = clamp(index, 0, channelList.length - 1);
    const channel = this.rootDataStore.channelStore.channelList[nextIndex];

    dispatch(new ChatChannelSwitchAction(channel.channelId));
  }

  private handleChatChannelDeletedAction(action: ChatChannelDeletedAction) {
    this.focusChannelAtIndex(this.selectedIndex);
  }

  private handleChatChannelJoinAction(action: ChatChannelJoinAction) {
    transaction(() => {
      const channelStore = this.rootDataStore.channelStore;
      const channel = channelStore.getOrCreate(action.channelId);
      channel.icon = action.icon ?? defaultIcon;
      channel.name = action.name;
      channel.type = action.type;
      channel.metaLoaded = true;
    });
  }

  private handleChatChannelSwitchAction(channelId: number) {
    const channelStore = this.rootDataStore.channelStore;
    // FIXME: changing to a channel that doesn't exist yet from an external message should create the channel before switching.
    const channel = channelStore.getOrCreate(channelId);

    transaction(() => {
      // TODO: this should probably be in the store?
      if (!channel.newPmChannel) {
        this.loadChannel(channelId).then(() => {
          this.markAsRead(channelId);
        });
      }

      this.selectedIndex = channelStore.channelList.indexOf(channel);
    });
  }

  private markAsRead(channelId: number) {
    if (!this.windowIsActive || this.markingAsRead[channelId] != null) {
      return;
    }

    const channel = this.rootDataStore.channelStore.getOrCreate(channelId);

    if (!channel.isUnread) {
      return;
    }

    channel.markAsRead();

    const currentTimeout = window.setTimeout(() => {
      // allow next debounce to be queued again
      if (this.markingAsRead[channelId] === currentTimeout) {
        delete this.markingAsRead[channelId];
      }

      // TODO: need to mark again in case the marker has moved?

      // We don't need to send mark-as-read for our own messages, as the cursor is automatically bumped forward server-side when sending messages.
      const lastSentMessage = channel.messages[channel.messages.length - 1];
      if (lastSentMessage && lastSentMessage.sender.id === window.currentUser.id) {
        return;
      }

      this.api.markAsRead(channel.channelId, channel.lastMessageId).catch((err) => {
        console.debug('markAsRead error', err);
      });
    }, 1000);

    this.markingAsRead[channelId] = currentTimeout;
  }
}
