// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetSearchController } from 'beatmaps/beatmapset-search-controller';
import Captcha from 'captcha';
import ChatWorker from 'chat/chat-worker';
import ClickMenu from 'click-menu';
import Enchant from 'enchant';
import ForumPoll from 'forum-poll';
import CurrentUser from 'interfaces/current-user';
import UserJson from 'interfaces/user-json';
import Localtime from 'localtime';
import MobileToggle from 'mobile-toggle';
import NotificationsWorker from 'notifications/worker';
import OsuAudio from 'osu-audio/main';
import OsuLayzr from 'osu-layzr';
import SocketWorker from 'socket-worker';
import RootDataStore from 'stores/root-data-store';
import TurbolinksReload from 'turbolinks-reload';
import UserLogin from 'user-login';
import UserLoginObserver from 'user-login-observer';
import WindowVHPatcher from 'window-vh-patcher';
import WindowFocusObserver from './window-focus-observer';

declare global {
  interface Window {
    currentUser: CurrentUser;
  }
}

// will this replace main.coffee eventually?
export default class OsuCore {
  get currentUser() {
    // FIXME: id is  not nullable but guest user does not have id.
    return window.currentUser.id != null ? window.currentUser : null;
  }

  beatmapsetSearchController: BeatmapsetSearchController;
  readonly captcha = new Captcha();
  chatWorker: ChatWorker;
  readonly clickMenu = new ClickMenu();
  dataStore: RootDataStore;
  readonly enchant: Enchant;
  readonly forumPoll = new ForumPoll();
  readonly localtime = new Localtime();
  readonly mobileToggle = new MobileToggle();
  notificationsWorker: NotificationsWorker;
  readonly osuAudio = new OsuAudio();
  readonly osuLayzr = new OsuLayzr();
  socketWorker: SocketWorker;
  readonly turbolinksReload = new TurbolinksReload();
  readonly userLogin: UserLogin;
  userLoginObserver: UserLoginObserver;
  windowFocusObserver: WindowFocusObserver;
  readonly windowVHPatcher = new WindowVHPatcher();

  constructor() {
    this.enchant = new Enchant(this.turbolinksReload);
    this.userLogin = new UserLogin(this.captcha);
    // should probably figure how to conditionally or lazy initialize these so they don't all init when not needed.
    // TODO: requires dynamic imports to lazy load modules.
    this.dataStore = new RootDataStore();
    this.chatWorker = new ChatWorker(this.dataStore.channelStore);
    this.userLoginObserver = new UserLoginObserver();
    this.windowFocusObserver = new WindowFocusObserver();

    this.beatmapsetSearchController = new BeatmapsetSearchController(this.dataStore.beatmapsetSearch);

    this.socketWorker = new SocketWorker();
    this.notificationsWorker = new NotificationsWorker(this.socketWorker);

    // script could load before currentUser is set, so wait until page loaded.
    $(document).on('turbolinks:load.osu-core', () => {
      if (window.currentUser != null) {
        this.dataStore.userStore.getOrCreate(window.currentUser.id, window.currentUser);
      }
      $(document).off('turbolinks:load.osu-core');
    });

    $.subscribe('user:update', this.setUser);
    $(() => this.socketWorker.setUserId(currentUser.id));
  }

  private setUser = (event: JQuery.Event, user: UserJson) => {
    this.dataStore.userStore.getOrCreate(user.id, user);
    this.socketWorker.setUserId(user.id);
  }
}
