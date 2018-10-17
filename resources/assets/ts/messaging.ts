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

import MainView from "./messaging/main-view";
import RootDataStore from "./stores/root-data-store";
import ChatOrchestrator from "./messaging/chat-orchestrator";
import ChatWorker from "./messaging/chat-worker";
import Dispatcher from "./dispatcher";
import WindowFocusObserver from "./window-focus-observer";

declare global {
  interface Window {
    DataStore: RootDataStore;
    Dispatcher: Dispatcher;
    ChatOrchestrator: ChatOrchestrator;
    ChatWorker: ChatWorker;
    WindowFocusObserver: WindowFocusObserver;
  }
}

let datastore: RootDataStore;
let dispatcher: Dispatcher;
let chatOrchestrator: ChatOrchestrator;
let chatWorker: ChatWorker;
let windowFocusObserver: WindowFocusObserver;

if (window.Dispatcher) {
  dispatcher = window.Dispatcher;
} else {
  window.Dispatcher = dispatcher = new Dispatcher();
}

if (window.DataStore) {
  datastore = window.DataStore;
} else {
  window.DataStore = datastore = new RootDataStore(dispatcher);
}

datastore.userStore.getOrCreate(currentUser.id, currentUser);

if (window.ChatOrchestrator) {
  chatOrchestrator = window.ChatOrchestrator;
} else {
  window.ChatOrchestrator = chatOrchestrator = new ChatOrchestrator(dispatcher, datastore);
}

if (window.ChatWorker) {
  chatWorker = window.ChatWorker;
} else {
  window.ChatWorker = chatWorker = new ChatWorker(dispatcher, datastore);
}

if (window.WindowFocusObserver) {
  windowFocusObserver = window.WindowFocusObserver;
} else {
  window.WindowFocusObserver = windowFocusObserver = new WindowFocusObserver(window, dispatcher);
}

reactTurbolinks.register('messaging', MainView, function () {
  return {
    presence: osu.parseJson('json-presence'),
    dataStore: datastore,
    dispatcher: dispatcher,
    orchestrator: chatOrchestrator,
    worker: chatWorker,
  }
});
