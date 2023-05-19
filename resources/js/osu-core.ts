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
  readonly beatmapsetSearchController;
  readonly captcha;
  readonly chatWorker;
  readonly clickMenu;
  @observable currentUser?: CurrentUserJson;
  readonly currentUserModel;
  readonly dataStore;
  readonly enchant;
  readonly forumPoll;
  readonly forumPostEdit;
  readonly forumPostInput;
  readonly forumPostReport;
  readonly localtime;
  readonly mobileToggle;
  readonly notificationsWorker;
  readonly osuAudio;
  readonly reactTurbolinks;
  readonly referenceLinkTooltip;
  readonly scorePins;
  readonly socketWorker;
  readonly stickyHeader;
  readonly timeago;
  readonly turbolinksReload;
  readonly userLogin;
  readonly userLoginObserver;
  readonly userPreferences;
  readonly userVerification;
  readonly windowFocusObserver;
  readonly windowSize;

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
    const isLoading = document.readyState === 'loading';
    if (isLoading) {
      document.addEventListener('DOMContentLoaded', this.updateCurrentUser);
    }
    $.subscribe('user:update', this.onCurrentUserUpdate);

    this.captcha = new Captcha();
    this.chatWorker = new ChatWorker();
    this.clickMenu = new ClickMenu();
    this.currentUserModel = new UserModel(this);
    this.forumPoll = new ForumPoll();
    this.forumPostEdit = new ForumPostEdit();
    this.forumPostInput = new ForumPostInput();
    this.forumPostReport = new ForumPostReport();
    this.localtime = new Localtime();
    this.mobileToggle = new MobileToggle();
    this.referenceLinkTooltip = new ReferenceLinkTooltip();
    this.scorePins = new ScorePins();
    this.stickyHeader = new StickyHeader();
    this.timeago = new Timeago();
    this.turbolinksReload = new TurbolinksReload();
    this.userPreferences = new UserPreferences();
    this.userVerification = new UserVerification();
    this.windowSize = new WindowSize();

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

    if (!isLoading) {
      this.updateCurrentUser();
    }
  }

  readonly updateCurrentUser = () => {
    // Remove from DOM so only new data is parsed on navigation.
    const currentUser = parseJsonNullable<typeof window.currentUser>('json-current-user', true);

    if (currentUser != null) {
      window.currentUser = currentUser;
      this.setCurrentUser(window.currentUser);
    }
  };

  private readonly onCurrentUserUpdate = (event: unknown, user: CurrentUserJson) => {
    this.setCurrentUser(user);
  };

  @action
  private readonly setCurrentUser = (userOrEmpty: typeof window.currentUser) => {
    const user = userOrEmpty.id == null ? undefined : userOrEmpty;

    if (user != null) {
      this.dataStore.userStore.update(user);
    }
    this.socketWorker.setUserId(user?.id ?? null);
    this.currentUser = user;
    this.userPreferences.setUser(this.currentUser);
  };
}
