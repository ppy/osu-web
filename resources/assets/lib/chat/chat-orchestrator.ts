// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import {
  ChatChannelPartAction,
  ChatChannelSwitchAction,
} from 'actions/chat-actions';
import DispatcherAction from 'actions/dispatcher-action';
import { WindowBlurAction, WindowFocusAction } from 'actions/window-focus-actions';
import { dispatch, dispatchListener } from 'app-dispatcher';
import DispatchListener from 'dispatch-listener';
import { clamp } from 'lodash';
import { transaction } from 'mobx';
import RootDataStore from 'stores/root-data-store';
import ChatAPI from './chat-api';

@dispatchListener
export default class ChatOrchestrator implements DispatchListener {
  private api: ChatAPI;
  private windowIsActive: boolean = true;

  constructor(private rootDataStore: RootDataStore) {
    this.rootDataStore = rootDataStore;
    this.api = new ChatAPI();
  }

  changeChannel(channelId: number) {
    const uiState = this.rootDataStore.chatState;
    const channelStore = this.rootDataStore.channelStore;

    if (channelId === uiState.selected && !channelStore.getOrCreate(channelId).loaded) {
      return;
    }

    transaction(async () => {
      if (!channelStore.getOrCreate(uiState.selected).transient) {
        // don't disable autoScroll if we're 'switching' away from the 'new chat' screen
        //   e.g. keep autoScroll enabled to jump to the newly sent message when restarting an old conversation
        uiState.autoScroll = false;
      }
      const channel = channelStore.getOrCreate(channelId);

      if (!channel.newPmChannel) {
        if (channel.loaded) {
          this.rootDataStore.channelStore.markAsRead(channelId);
        } else {
          await this.rootDataStore.channelStore.loadChannel(channelId);
          if (this.windowIsActive) {
            this.rootDataStore.channelStore.markAsRead(channelId);
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
    } else if (action instanceof ChatChannelPartAction) {
      this.handleChatChannelPartAction(action);
    } else if (action instanceof WindowFocusAction) {
      this.windowIsActive = true;
      if (this.rootDataStore.channelStore.loaded) {
        this.rootDataStore.channelStore.markAsRead(this.rootDataStore.chatState.selected);
      }
    } else if (action instanceof WindowBlurAction) {
      this.windowIsActive = false;
    }
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
}
