// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ChatMessageSendAction } from 'actions/chat-actions';
import ChatNewConversationAdded from 'actions/chat-new-conversation-added';
import DispatcherAction from 'actions/dispatcher-action';
import { UserLogoutAction } from 'actions/user-login-actions';
import { WindowFocusAction } from 'actions/window-focus-actions';
import { dispatchListener } from 'app-dispatcher';
import { clamp } from 'lodash';
import { action, computed, observable } from 'mobx';
import ChannelStore from 'stores/channel-store';

@dispatchListener
export default class ChatStateStore {
  @observable autoScroll = false;
  @observable lastReadId = -1;
  @observable selectedBoxed = observable.box(0);
  private selectedIndex = 0;

  @computed
  get selected() {
    return this.selectedBoxed.get();
  }

  set selected(value: number) {
    this.selectedBoxed.set(value);
  }

  @computed
  get selectedChannel() {
    return this.channelStore.get(this.selected);
  }

  constructor(protected channelStore: ChannelStore) {
    channelStore.channels.observe((changes) => {
      // refocus channels if any gets removed
      if (changes.type === 'delete') {
        this.refocusSelectedChannel();
      }
    });
  }

  @action
  flushStore() {
    this.selected = 0;
    this.lastReadId = -1;
    this.autoScroll = false;
  }

  handleDispatchAction(dispatchedAction: DispatcherAction) {
    if (dispatchedAction instanceof ChatMessageSendAction) {
      this.autoScroll = true;
    } else if (dispatchedAction instanceof ChatNewConversationAdded) {
      this.handleChatNewConversationAdded(dispatchedAction);
    } else if (dispatchedAction instanceof UserLogoutAction) {
      this.flushStore();
    } else if (dispatchedAction instanceof WindowFocusAction) {
      this.handleWindowFocusAction();
    }
  }

  @action
  selectChannel(channelId: number) {
    if (this.selected === channelId) return;

    const channel = this.channelStore.get(channelId);
    if (channel == null) {
      console.error(`Trying to switch to non-existent channel ${channelId}`);
      return;
    }

    if (!(this.selectedChannel?.transient ?? true)) {
      // don't disable autoScroll if we're 'switching' away from the 'new chat' screen
      //   e.g. keep autoScroll enabled to jump to the newly sent message when restarting an old conversation
      this.autoScroll = false;
    }

    this.selected = channelId;
    this.selectedIndex = this.channelStore.channelList.indexOf(channel);
    this.lastReadId = channel.lastReadId ?? -1;

    // TODO: should this be here or have something else figure out if channel needs to be loaded?
    this.channelStore.loadChannel(channelId).then(() => {
      this.channelStore.markAsRead(channelId);
    });
  }

  @action
  private focusChannelAtIndex(index: number) {
    const channelList = this.channelStore.channelList;
    if (channelList.length === 0) {
      return;
    }

    const nextIndex = clamp(index, 0, channelList.length - 1);
    const channel = this.channelStore.channelList[nextIndex];

    this.selectChannel(channel.channelId);
  }

  @action
  private handleChatNewConversationAdded(dispatchedAction: ChatNewConversationAdded) {
    // TODO: currently only the current window triggers the action, but this should be updated
    // to ignore unfocused windows once new conversation added messages start getting triggered over the websocket.
    this.selectChannel(dispatchedAction.channelId);
  }

  @action
  private handleWindowFocusAction() {
    this.channelStore.markAsRead(this.selected);
  }

  @action
  /**
   * Keeps the current channel in focus, unless deleted, then focus on next channel.
   */
  private refocusSelectedChannel() {
    if (this.selectedChannel != null) {
      this.selectChannel(this.selectedChannel.channelId);
    } else {
      this.focusChannelAtIndex(this.selectedIndex);
    }
  }
}
