// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ChatChannelDeletedAction, ChatChannelSwitchAction, ChatMessageSendAction } from 'actions/chat-actions';
import DispatcherAction from 'actions/dispatcher-action';
import { UserLogoutAction } from 'actions/user-login-actions';
import { dispatch, dispatchListener } from 'app-dispatcher';
import { clamp } from 'lodash';
import { action, computed, observable } from 'mobx';
import Store from 'stores/store';

@dispatchListener
export default class ChatStateStore extends Store {
  @observable autoScroll: boolean = false;
  @observable selected: number = 0;
  private selectedIndex = 0;

  @computed
  get lastReadId() {
    return this.root.channelStore.get(this.selected)?.lastReadId ?? -1;
  }

  @action
  flushStore() {
    this.selected = 0;
  }

  handleDispatchAction(dispatchedAction: DispatcherAction) {
    if (dispatchedAction instanceof ChatChannelDeletedAction) {
      this.handleChatChannelDeletedAction();
    } else if (dispatchedAction instanceof ChatChannelSwitchAction) {
      this.handleChatChannelSwitchAction(dispatchedAction);
    } else if (dispatchedAction instanceof ChatMessageSendAction) {
      this.autoScroll = true;
    } else if (dispatchedAction instanceof UserLogoutAction) {
      this.flushStore();
    }
  }

  @action
  selectChannel(channelId: number) {
    if (this.selected !== channelId) {
      if (this.root.channelStore.get(channelId) == null) {
        console.error(`Trying to switch to non-existent channel ${channelId}`);
        return;
      }

      if (!(this.root.channelStore.get(this.selected)?.transient ?? true)) {
        // don't disable autoScroll if we're 'switching' away from the 'new chat' screen
        //   e.g. keep autoScroll enabled to jump to the newly sent message when restarting an old conversation
        this.autoScroll = false;
      }

      this.selected = channelId;
      dispatch(new ChatChannelSwitchAction(channelId));
    }
  }

  @action
  private focusChannelAtIndex(index: number) {
    const channelList = this.root.channelStore.channelList;
    if (channelList.length === 0) {
      return;
    }

    const nextIndex = clamp(index, 0, channelList.length - 1);
    const channel = this.root.channelStore.channelList[nextIndex];

    this.selectChannel(channel.channelId);
  }

  @action
  private handleChatChannelDeletedAction() {
    this.focusChannelAtIndex(this.selectedIndex);
  }

  @action
  private handleChatChannelSwitchAction(dispatchedAction: ChatChannelSwitchAction) {
    const channelStore = this.root.channelStore;
    const channelId = dispatchedAction.channelId;
    // FIXME: changing to a channel that doesn't exist yet from an external message should create the channel before switching.
    const channel = channelStore.getOrCreate(channelId);

    channelStore.loadChannel(channelId).then(() => {
      // this.markAsRead(channelId);
    });

    this.selectedIndex = channelStore.channelList.indexOf(channel);
  }
}
