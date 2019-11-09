/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import { ChatChannelSwitchAction, ChatMessageSendAction } from 'actions/chat-actions';
import DispatcherAction from 'actions/dispatcher-action';
import { UserLogoutAction } from 'actions/user-login-actions';
import { action, observable } from 'mobx';
import Store from 'stores/store';

export default class ChatStateStore extends Store {
  @observable autoScroll: boolean = false;
  @observable lastReadId: number = -1;
  @observable selected: number = -1;

  @action
  flushStore() {
    this.selected = -1;
    this.lastReadId = -1;
  }

  handleDispatchAction(dispatchedAction: DispatcherAction) {
    if (dispatchedAction instanceof ChatChannelSwitchAction) {
      const lastReadId = this.root.channelStore.getOrCreate(dispatchedAction.channelId).lastReadId;
      if (lastReadId != null) {
        this.lastReadId = lastReadId;
      }
    } else if (dispatchedAction instanceof ChatMessageSendAction) {
      this.lastReadId = this.root.channelStore.getOrCreate(dispatchedAction.message.channelId).lastMessageId;
      this.autoScroll = true;
    } else if (dispatchedAction instanceof UserLogoutAction) {
      this.flushStore();
    }
  }
}
