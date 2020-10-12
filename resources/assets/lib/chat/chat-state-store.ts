// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ChatChannelSwitchAction, ChatMessageSendAction } from 'actions/chat-actions';
import DispatcherAction from 'actions/dispatcher-action';
import { UserLogoutAction } from 'actions/user-login-actions';
import { dispatchListener } from 'app-dispatcher';
import { action, observable } from 'mobx';
import ChannelStore from 'stores/channel-store';

@dispatchListener
export default class ChatStateStore {
  @observable autoScroll: boolean = false;
  @observable lastReadId: number = -1;
  @observable selected: number = -1;

  constructor(protected channelStore: ChannelStore) {
  }

  @action
  flushStore() {
    this.selected = -1;
    this.lastReadId = -1;
  }

  handleDispatchAction(dispatchedAction: DispatcherAction) {
    if (dispatchedAction instanceof ChatChannelSwitchAction) {
      this.lastReadId = this.channelStore.getOrCreate(dispatchedAction.channelId).lastReadId || -1;
    } else if (dispatchedAction instanceof ChatMessageSendAction) {
      this.lastReadId = this.channelStore.getOrCreate(dispatchedAction.message.channelId).lastMessageId || -1;
      this.autoScroll = true;
    } else if (dispatchedAction instanceof UserLogoutAction) {
      this.flushStore();
    }
  }
}
