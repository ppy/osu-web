// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetSearchController } from 'beatmaps/beatmapset-search-controller';
import ChatWorker from 'chat/chat-worker';
import Captcha from 'core/captcha';
import ClickMenu from 'core/click-menu';
import Enchant from 'core/enchant';
import ForumPoll from 'core/forum/forum-poll';
import ForumPostEdit from 'core/forum/forum-post-edit';
import ForumPostInput from 'core/forum/forum-post-input';
import ForumPostReport from 'core/forum/forum-post-report';
import Localtime from 'core/localtime';
import MobileToggle from 'core/mobile-toggle';
import OsuAudio from 'core/osu-audio/main';
import ReactTurbolinks from 'core/react-turbolinks';
import StickyHeader from 'core/sticky-header';
import Timeago from 'core/timeago';
import TurbolinksReload from 'core/turbolinks-reload';
import ScorePins from 'core/user/score-pins';
import UserLogin from 'core/user/user-login';
import UserLoginObserver from 'core/user/user-login-observer';
import UserModel from 'core/user/user-model';
import UserPreferences from 'core/user/user-preferences';
import UserVerification from 'core/user/user-verification';
import ReferenceLinkTooltip from 'core/wiki/reference-link-tooltip';
import WindowFocusObserver from 'core/window-focus-observer';
import WindowSize from 'core/window-size';
import CurrentUserJson from 'interfaces/current-user-json';
import { action, computed, makeObservable, observable } from 'mobx';
import NotificationsWorker from 'notifications/worker';
import SocketWorker from 'socket-worker';
import RootDataStore from 'stores/root-data-store';
import { parseJsonNullable } from 'utils/json';

// will this replace main.coffee eventually?
export default class OsuCore {
  beatmapsetSearchController: BeatmapsetSearchController;
  readonly captcha = new Captcha();
  readonly chatWorker = new ChatWorker();
  readonly clickMenu = new ClickMenu();
  @observable currentUser?: CurrentUserJson;
  readonly currentUserModel = new UserModel(this);
  dataStore: RootDataStore;
  readonly enchant: Enchant;
  readonly forumPoll = new ForumPoll();
  readonly forumPostEdit = new ForumPostEdit();
  readonly forumPostInput = new ForumPostInput();
  readonly forumPostReport = new ForumPostReport();
  readonly localtime = new Localtime();
  readonly mobileToggle = new MobileToggle();
  notificationsWorker: NotificationsWorker;
  readonly osuAudio: OsuAudio;
  readonly reactTurbolinks: ReactTurbolinks;
  readonly referenceLinkTooltip = new ReferenceLinkTooltip();
  readonly scorePins = new ScorePins();
  @observable scrolling = false;
  socketWorker: SocketWorker;
  readonly stickyHeader = new StickyHeader();
  readonly timeago = new Timeago();
  readonly turbolinksReload = new TurbolinksReload();
  readonly userLogin: UserLogin;
  userLoginObserver: UserLoginObserver;
  readonly userPreferences = new UserPreferences();
  readonly userVerification = new UserVerification();
  windowFocusObserver: WindowFocusObserver;
  readonly windowSize = new WindowSize();

  @computed
  get currentUserOrFail() {
    if (this.currentUser == null) {
      throw new Error('current user is null');
    }

    return this.currentUser;
  }

  constructor() {
    // Set current user on first page load. Further updates are done in
    // reactTurbolinks before the new page is rendered.
    // This needs to be fired before everything else (turbolinks:load etc).
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', this.updateCurrentUser);
    } else {
      this.updateCurrentUser();
    }
    $.subscribe('user:update', this.onCurrentUserUpdate);

    this.enchant = new Enchant(this.turbolinksReload);
    this.osuAudio = new OsuAudio(this.userPreferences);
    this.reactTurbolinks = new ReactTurbolinks(this, this.turbolinksReload);
    this.userLogin = new UserLogin(this.captcha);
    // should probably figure how to conditionally or lazy initialize these so they don't all init when not needed.
    // TODO: requires dynamic imports to lazy load modules.
    this.dataStore = new RootDataStore();
    this.userLoginObserver = new UserLoginObserver();
    this.windowFocusObserver = new WindowFocusObserver();

    this.beatmapsetSearchController = new BeatmapsetSearchController(this.dataStore.beatmapsetSearch);

    this.socketWorker = new SocketWorker();
    this.notificationsWorker = new NotificationsWorker(this.socketWorker);

    makeObservable(this);
  }

  readonly updateCurrentUser = () => {
    // Remove from DOM so only new data is parsed on navigation.
    window.currentUser = parseJsonNullable('json-current-user', true) ?? { id: undefined };
    this.setCurrentUser(window.currentUser);
  };

  private onCurrentUserUpdate = (event: unknown, user: CurrentUserJson) => {
    this.setCurrentUser(user);
  };

  @action
  private setCurrentUser = (userOrEmpty: typeof window.currentUser) => {
    const user = userOrEmpty.id == null ? undefined : userOrEmpty;

    if (user != null) {
      this.dataStore.userStore.update(user);
    }
    this.socketWorker.setUserId(user?.id ?? null);
    this.currentUser = user;
    this.userPreferences.setUser(this.currentUser);
  };
}
