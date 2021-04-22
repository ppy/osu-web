// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetSearchController } from 'beatmaps/beatmapset-search-controller';
import Captcha from 'captcha';
import ChatWorker from 'chat/chat-worker';
import ClickMenu from 'click-menu';
import Enchant from 'enchant';
import ForumPoll from 'forum-poll';
import CurrentUser from 'interfaces/current-user';
import Localtime from 'localtime';
import MobileToggle from 'mobile-toggle';
import { observable } from 'mobx';
import NotificationsWorker from 'notifications/worker';
import OsuAudio from 'osu-audio/main';
import OsuLayzr from 'osu-layzr';
import SocketWorker from 'socket-worker';
import RootDataStore from 'stores/root-data-store';
import TurbolinksReload from 'turbolinks-reload';
import UserLogin from 'user-login';
import UserLoginObserver from 'user-login-observer';
import UserVerification from 'user-verification';
import WindowVHPatcher from 'window-vh-patcher';
import WindowFocusObserver from './window-focus-observer';

declare global {
  interface Window {
    currentUser: CurrentUser;
  }
}

// will this replace main.coffee eventually?
export default class OsuCore {
  beatmapsetSearchController: BeatmapsetSearchController;
  readonly captcha = new Captcha();
  chatWorker: ChatWorker;
  readonly clickMenu = new ClickMenu();
  @observable currentUser?: CurrentUser;
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
  readonly userVerification = new UserVerification();
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

    // refresh current user on page reload (and initial page load)
    $(document).on('turbolinks:load.osu-core', this.onPageLoad);
    $.subscribe('user:update', this.onCurrentUserUpdate);
  }

  private onCurrentUserUpdate = (event: unknown, user: CurrentUser) => {
    this.setCurrentUser(user);
  };

  private onPageLoad = () => {
    this.setCurrentUser(window.currentUser);
  };

  private setCurrentUser = (user: CurrentUser) => {
    this.dataStore.userStore.getOrCreate(user.id, user);
    this.socketWorker.setUserId(user.id);
    this.currentUser = user.id == null ? undefined : user;
  };
}
