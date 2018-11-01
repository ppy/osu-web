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

import ChatOrchestrator from './chat/chat-orchestrator';
import ChatWorker from './chat/chat-worker';
import Dispatcher from './dispatcher';
import RootDataStore from './stores/root-data-store';
import WindowFocusObserver from './window-focus-observer';
import WindowVHPatcher from './window-vh-patcher';

// will this replace main.coffee eventually?
export default class OsuCore {
  Window: Window;
  Dispatcher: Dispatcher;
  DataStore: RootDataStore;
  ChatWorker: ChatWorker;
  ChatOrchestrator: ChatOrchestrator;
  WindowFocusObserver: WindowFocusObserver;
  WindowVHPatcher: WindowVHPatcher;

  constructor(window: Window) {
    this.Window = window;
    this.Dispatcher = new Dispatcher();
    this.DataStore = new RootDataStore(this.Dispatcher);
    this.ChatWorker = new ChatWorker(this.Dispatcher, this.DataStore);
    this.ChatOrchestrator = new ChatOrchestrator(this.Dispatcher, this.DataStore);
    this.WindowFocusObserver = new WindowFocusObserver(this.Window, this.Dispatcher);
    this.WindowVHPatcher = new WindowVHPatcher(this.Window);

    if (currentUser !== null) {
      this.DataStore.userStore.getOrCreate(currentUser.id, currentUser);
    }
  }
}
