// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ChatMessageSendAction } from 'actions/chat-actions';
import DispatcherAction from 'actions/dispatcher-action';
import { UserLogoutAction } from 'actions/user-login-actions';
import { dispatchListener } from 'app-dispatcher';
import { action, computed, observable } from 'mobx';
import Store from 'stores/store';

@dispatchListener
export default class ChatStateStore extends Store {
  @observable autoScroll: boolean = false;
  @observable selected: number = -1;

  @computed
  get lastReadId() {
    return this.root.channelStore.get(this.selected)?.lastReadId ?? -1;
  }

  @action
  flushStore() {
    this.selected = -1;
  }

  handleDispatchAction(dispatchedAction: DispatcherAction) {
    if (dispatchedAction instanceof ChatMessageSendAction) {
      this.autoScroll = true;
    } else if (dispatchedAction instanceof UserLogoutAction) {
      this.flushStore();
    }
  }
}
