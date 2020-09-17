// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import {
  ChatChannelJoinAction,
  ChatChannelLoadEarlierMessages,
  ChatChannelNewMessages,
} from 'actions/chat-actions';
import DispatcherAction from 'actions/dispatcher-action';
import { WindowBlurAction, WindowFocusAction } from 'actions/window-focus-actions';
import { dispatch, dispatchListener } from 'app-dispatcher';
import DispatchListener from 'dispatch-listener';
import { transaction } from 'mobx';
import { defaultIcon } from 'models/chat/channel';
import RootDataStore from 'stores/root-data-store';
import ChatAPI from './chat-api';

@dispatchListener
export default class ChatOrchestrator implements DispatchListener {
  private api = new ChatAPI();
  private markingAsRead: Record<number, number> = {};
  private windowIsActive: boolean = true;

  constructor(private rootDataStore: RootDataStore) {
  }

  handleDispatchAction(action: DispatcherAction) {
    if (action instanceof ChatChannelLoadEarlierMessages) {
      this.loadChannelEarlierMessages(action.channelId);
    } else if (action instanceof ChatChannelJoinAction) {
      this.handleChatChannelJoinAction(action);
    } else if (action instanceof WindowFocusAction) {
      this.windowIsActive = true;
      this.markAsRead(this.rootDataStore.uiState.chat.selected);
    } else if (action instanceof WindowBlurAction) {
      this.windowIsActive = false;
    }
  }

  loadChannelEarlierMessages(channelId: number) {
    const channel = this.rootDataStore.channelStore.get(channelId);

    if (channel == null || !channel.hasEarlierMessages || channel.loadingEarlierMessages) {
      return;
    }

    channel.loadingEarlierMessages = true;
    let until: number | undefined;
    // FIXME: nullable id instead?
    if (channel.minMessageId > 0) {
      until = channel.minMessageId;
    }

    this.api.getMessages(channel.channelId, { until })
      .then((response) => {
        transaction(() => {
          channel.loadingEarlierMessages = false;
          dispatch(new ChatChannelNewMessages(channelId, response));
        });
      }).catch((err) => {
        channel.loadingEarlierMessages = false;
        console.debug('loadChannelEarlierMessages error', err);
      });
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
