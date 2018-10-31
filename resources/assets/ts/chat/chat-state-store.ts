/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import { ChatChannelSwitchAction, ChatMessageSendAction } from 'actions/chat-actions';
import DispatcherAction from 'actions/dispatcher-action';
import DispatchListener from 'dispatch-listener';
import Dispatcher from 'dispatcher';
import { observable } from 'mobx';
import RootDataStore from 'stores/root-data-store';
import UIStateStore from 'stores/ui-state-store';

export default class ChatStateStore implements DispatchListener {
  root: RootDataStore;
  parent: UIStateStore; // TODO: do we need to bother with tracking parent?
  dispatcher: Dispatcher;

  @observable selected: number = -1;
  @observable lastReadId: number = -1;

  constructor(root: RootDataStore, parent: UIStateStore, dispatcher: Dispatcher) {
    this.root = root;
    this.parent = parent;
    this.dispatcher = dispatcher;
    dispatcher.register(this);
  }

  handleDispatchAction(action: DispatcherAction) {
    if (action instanceof ChatChannelSwitchAction) {
      this.lastReadId = this.root.channelStore.getOrCreate(action.channelId).lastReadId;
    }

    if (action instanceof ChatMessageSendAction) {
      this.lastReadId = this.root.channelStore.getOrCreate(action.message.channelId).lastMessageId;
    }
  }
}
