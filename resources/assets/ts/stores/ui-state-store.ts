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

import RootDataStore from "./root-data-store";
import ChatStateStore from "../messaging/chat-state-store";
import DispatchListener from "../dispatch-listener";
import DispatcherAction from "../actions/dispatcher-action";
import Dispatcher from "../dispatcher";

export default class UIStateStore implements DispatchListener {
  parent: RootDataStore

  chat: ChatStateStore;

  constructor(root: RootDataStore, dispatcher: Dispatcher) {
    this.parent = root;
    this.chat = new ChatStateStore(this);
    dispatcher.register(this);
  }

  handleDispatchAction(action: DispatcherAction) {
  }
}
