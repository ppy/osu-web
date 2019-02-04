/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

import ChatOrchestrator from 'chat/chat-orchestrator';
import ChatWorker from 'chat/chat-worker';
import RootDataStore from 'stores/root-data-store';
import UserLoginObserver from 'user-login-observer';
import Dispatcher from './dispatcher';
import WindowFocusObserver from './window-focus-observer';

// will this replace main.coffee eventually?
export default class OsuCore {
  window: Window;
  dispatcher: Dispatcher;
  dataStore: RootDataStore;
  chatWorker: ChatWorker;
  chatOrchestrator: ChatOrchestrator;
  userLoginObserver: UserLoginObserver;
  windowFocusObserver: WindowFocusObserver;

  constructor(window: Window) {
    this.window = window;
    // should probably figure how to conditionally or lazy initialize these so they don't all init when not needed.
    this.dispatcher = new Dispatcher();
    this.dataStore = new RootDataStore(this.dispatcher);
    this.chatWorker = new ChatWorker(this.dispatcher, this.dataStore);
    this.chatOrchestrator = new ChatOrchestrator(this.dispatcher, this.dataStore);
    this.userLoginObserver = new UserLoginObserver(this.window, this.dispatcher);
    this.windowFocusObserver = new WindowFocusObserver(this.window, this.dispatcher);

    if (currentUser !== null) {
      this.dataStore.userStore.getOrCreate(currentUser.id, currentUser);
    }
  }
}
