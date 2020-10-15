// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ChatChannelSwitchAction, ChatMessageSendAction } from 'actions/chat-actions';
import DispatcherAction from 'actions/dispatcher-action';
import { UserLogoutAction } from 'actions/user-login-actions';
import { dispatchListener } from 'app-dispatcher';
import { action, computed, observable } from 'mobx';
import ChannelStore from 'stores/channel-store';

@dispatchListener
export default class ChatStateStore {
  @observable autoScroll = false;
  @observable lastReadId = -1;
  @observable selectedBoxed = observable.box(0);

  @computed
  get selected() {
    return this.selectedBoxed.get();
  }

  set selected(value: number) {
    this.selectedBoxed.set(value);
  }

  constructor(protected channelStore: ChannelStore) {
  }

  @action
  flushStore() {
    this.selected = 0;
    this.lastReadId = -1;
    this.autoScroll = false;
  }

  handleDispatchAction(event: DispatcherAction) {
    if (event instanceof ChatChannelSwitchAction) {
      this.lastReadId = this.channelStore.getOrCreate(event.channelId).lastReadId || -1;
    } else if (event instanceof ChatMessageSendAction) {
      this.lastReadId = this.channelStore.getOrCreate(event.message.channelId).lastMessageId || -1;
      this.autoScroll = true;
    } else if (event instanceof UserLogoutAction) {
      this.flushStore();
    }
  }
}
