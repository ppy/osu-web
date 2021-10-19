// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ChatMessageSendAction } from 'actions/chat-message-send-action';
import { ChatNewConversationAdded } from 'actions/chat-new-conversation-added';
import DispatcherAction from 'actions/dispatcher-action';
import { WindowFocusAction } from 'actions/window-focus-actions';
import { dispatchListener } from 'app-dispatcher';
import { clamp } from 'lodash';
import { action, computed, makeObservable, observable, observe } from 'mobx';
import ChannelStore from 'stores/channel-store';

@dispatchListener
export default class ChatStateStore {
  @observable autoScroll = false;
  @observable selectedBoxed = observable.box(0);
  private selectedIndex = 0;

  @computed
  get selected() {
    return this.selectedBoxed.get();
  }

  // This setter should be considered private.
  // Use selectChannel to change channel.
  set selected(value: number) {
    this.selectedBoxed.set(value);
  }

  @computed
  get selectedChannel() {
    return this.channelStore.get(this.selected);
  }

  constructor(protected channelStore: ChannelStore) {
    observe(channelStore.channels, (changes) => {
      // refocus channels if any gets removed
      if (changes.type === 'delete') {
        this.refocusSelectedChannel();
      }
    });

    makeObservable(this);
  }

  handleDispatchAction(event: DispatcherAction) {
    if (event instanceof ChatMessageSendAction) {
      this.autoScroll = true;
    } else if (event instanceof ChatNewConversationAdded) {
      this.handleChatNewConversationAdded(event);
    } else if (event instanceof WindowFocusAction) {
      this.handleWindowFocusAction();
    }
  }

  @action
  async selectChannel(channelId: number) {
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

    // TODO: should this be here or have something else figure out if channel needs to be loaded?
    await this.channelStore.loadChannel(channelId);
    this.channelStore.markAsRead(channelId);
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
  private handleChatNewConversationAdded(event: ChatNewConversationAdded) {
    // TODO: currently only the current window triggers the action, but this should be updated
    // to ignore unfocused windows once new conversation added messages start getting triggered over the websocket.
    this.selectChannel(event.channelId);
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
