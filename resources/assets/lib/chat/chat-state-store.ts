// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ChatChannelSwitchAction, ChatMessageSendAction } from 'actions/chat-actions';
import DispatcherAction from 'actions/dispatcher-action';
import { UserLogoutAction } from 'actions/user-login-actions';
import { dispatch, dispatchListener } from 'app-dispatcher';
import { action, computed, observable } from 'mobx';
import Store from 'stores/store';

@dispatchListener
export default class ChatStateStore extends Store {
  @observable autoScroll: boolean = false;
  @observable selected: number = 0;

  @computed
  get lastReadId() {
    return this.root.channelStore.get(this.selected)?.lastReadId ?? -1;
  }

  @action
  flushStore() {
    this.selected = 0;
  }

  handleDispatchAction(dispatchedAction: DispatcherAction) {
    if (dispatchedAction instanceof ChatMessageSendAction) {
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
}
