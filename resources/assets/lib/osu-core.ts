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

import { BeatmapsetSearchController } from 'beatmaps/beatmapset-search-controller';
import { UserJSON } from 'chat/chat-api-responses';
import ChatOrchestrator from 'chat/chat-orchestrator';
import ChatWorker from 'chat/chat-worker';
import RootDataStore from 'stores/root-data-store';
import UserLoginObserver from 'user-login-observer';
import WindowFocusObserver from './window-focus-observer';

declare global {
  interface Window {
    currentUser: UserJSON;
  }
}

// will this replace main.coffee eventually?
export default class OsuCore {
  beatmapsetSearchController: BeatmapsetSearchController;
  chatOrchestrator: ChatOrchestrator;
  chatWorker: ChatWorker;
  dataStore: RootDataStore;
  userLoginObserver: UserLoginObserver;
  window: Window;
  windowFocusObserver: WindowFocusObserver;

  constructor(window: Window) {
    this.window = window;
    // should probably figure how to conditionally or lazy initialize these so they don't all init when not needed.
    // TODO: requires dynamic imports to lazy load modules.
    this.dataStore = new RootDataStore();
    this.chatWorker = new ChatWorker(this.dataStore);
    this.chatOrchestrator = new ChatOrchestrator(this.dataStore);
    this.userLoginObserver = new UserLoginObserver(this.window);
    this.windowFocusObserver = new WindowFocusObserver(this.window);

    this.beatmapsetSearchController = new BeatmapsetSearchController(this.dataStore.beatmapsetSearch);

    // script could load before currentUser is set, so wait until page loaded.
    $(document).on('turbolinks:load.osu-core', () => {
      if (window.currentUser != null) {
        this.dataStore.userStore.getOrCreate(window.currentUser.id, window.currentUser);
      }
      $(document).off('turbolinks:load.osu-core');
    });

    $.subscribe('user:update', this.setUser);
  }

  get currentUser() {
    return window.currentUser;
  }

  private setUser = (event: JQuery.Event, user: UserJSON) => {
    this.dataStore.userStore.getOrCreate(user.id, user);
  }
}
