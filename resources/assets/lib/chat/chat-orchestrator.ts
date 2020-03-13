// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import {
  ChatChannelPartAction,
  ChatChannelSwitchAction,
  ChatMessageAddAction,
  ChatPresenceUpdateAction,
} from 'actions/chat-actions';
import DispatcherAction from 'actions/dispatcher-action';
import { WindowBlurAction, WindowFocusAction } from 'actions/window-focus-actions';
import { dispatch, dispatchListener } from 'app-dispatcher';
import DispatchListener from 'dispatch-listener';
import { transaction } from 'mobx';
import Message from 'models/chat/message';
import RootDataStore from 'stores/root-data-store';
import ChatAPI from './chat-api';
import { MessageJSON } from './chat-api-responses';

@dispatchListener
export default class ChatOrchestrator implements DispatchListener {
  private api: ChatAPI;
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
        newMessage.sender = this.rootDataStore.userStore.getOrCreate(json.sender_id, json.sender);
        newMessages.push(newMessage);
      });

      this.rootDataStore.channelStore.addMessages(channelId, newMessages);
    });
  }

  changeChannel(channelId: number) {
    const uiState = this.rootDataStore.uiState.chat;
    const channelStore = this.rootDataStore.channelStore;

    if (channelId === uiState.selected && !channelStore.getOrCreate(channelId).loaded) {
      return;
    }

    transaction(() => {
      if (channelStore.getOrCreate(uiState.selected).type !== 'NEW') {
        // don't disable autoScroll if we're 'switching' away from the 'new chat' screen
        //   e.g. keep autoScroll enabled to jump to the newly sent message when restarting an old conversation
        uiState.autoScroll = false;
      }
      const channel = channelStore.getOrCreate(channelId);

      if (!channel.newChannel) {
        if (channel.loaded) {
          this.markAsRead(channelId);
        } else {
          this.loadChannel(channelId)
            .then(() => {
              if (this.windowIsActive) {
                this.markAsRead(channelId);
              }
            });
        }
      }

      uiState.selected = channelId;
    });
  }

  focusNextChannel() {
    const channelStore = this.rootDataStore.channelStore;
    const channel = channelStore.get(this.rootDataStore.uiState.chat.selected);
    if (channel && (channel.exists || channel.newChannel)) {
      return;
    }

    const channelList = channelStore.channelList;
    if (channelList.length > 0) {
      // TODO: switch to next 'closest' conversation instead of first in list
      dispatch(new ChatChannelSwitchAction(channelList[0].channelId));
    } else {
      channelStore.loaded  = false;
    }
  }

  handleDispatchAction(action: DispatcherAction) {
    if (action instanceof ChatChannelSwitchAction) {
      this.changeChannel(action.channelId);
    } else if (action instanceof ChatChannelPartAction) {
      this.partChannel(action.channelId);
    } else if (action instanceof ChatMessageAddAction) {
      if (this.windowIsActive && this.rootDataStore.channelStore.loaded) {
        this.markAsRead(this.rootDataStore.uiState.chat.selected);
      }
    } else if (action instanceof ChatPresenceUpdateAction) {
      this.focusNextChannel();
    } else if (action instanceof WindowFocusAction) {
      this.windowIsActive = true;
      if (this.rootDataStore.channelStore.loaded) {
        this.markAsRead(this.rootDataStore.uiState.chat.selected);
      }
    } else if (action instanceof WindowBlurAction) {
      this.windowIsActive = false;
    }
  }

  loadChannel(channelId: number): Promise<void> {
    const channel = this.rootDataStore.channelStore.getOrCreate(channelId);

    if (channel.loading) {
      return Promise.resolve();
    }

    channel.loading = true;

    return this.api.getMessages(channelId)
      .then((messages) => {
        transaction(() => {
          this.addMessages(channelId, messages);
          channel.loading = false;
          channel.loaded = true;
        });
      })
      .catch((err) => {
        console.debug('loadChannel error', err);
      });
  }

  markAsRead(channelId: number) {
    const channel = this.rootDataStore.channelStore.getOrCreate(channelId);
    const lastReadId = channel.lastMessageId;

    if (!channel.isUnread) {
      return;
    }

    // We don't need to send mark-as-read for our own messages, as the cursor is automatically bumped forward server-side when sending messages.
    const lastSentMessage = channel.messages[channel.messages.length - 1];
    if (lastSentMessage && lastSentMessage.sender.id === window.currentUser.id) {
      channel.lastReadId = lastReadId;

      return;
    }

    this.api.markAsRead(channel.channelId, lastReadId)
      .then(() => {
        channel.lastReadId = lastReadId;
      })
      .catch((err) => {
        console.debug('markAsRead error', err);
      });
  }

  partChannel(channelId: number) {
    const channelStore = this.rootDataStore.channelStore;
    channelStore.partChannel(channelId);

    this.focusNextChannel();

    if (channelId !== -1) {
      return this.api.partChannel(channelId, window.currentUser.id)
        .catch((err) => {
          console.debug('leaveChannel error', err);
        });
    }
  }
}
