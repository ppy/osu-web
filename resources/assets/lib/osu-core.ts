// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetSearchController } from 'beatmaps/beatmapset-search-controller';
import ChatWorker from 'chat/chat-worker';
import CurrentUser from 'interfaces/current-user';
import UserJson from 'interfaces/user-json';
import RootDataStore from 'stores/root-data-store';
import UserLoginObserver from 'user-login-observer';
import WindowFocusObserver from './window-focus-observer';

declare global {
  interface Window {
    currentUser: CurrentUser;
  }
}

// will this replace main.coffee eventually?
export default class OsuCore {
  beatmapsetSearchController: BeatmapsetSearchController;
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
    this.chatWorker = new ChatWorker(this.dataStore.channelStore);
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
    // FIXME: id is  not nullable but guest user does not have id.
    return window.currentUser.id != null ? window.currentUser : null;
  }

  private setUser = (event: JQuery.Event, user: UserJson) => {
    this.dataStore.userStore.getOrCreate(user.id, user);
  }
}
