// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetSearchController } from 'beatmaps/beatmapset-search-controller';
import ChatWorker from 'chat/chat-worker';
import AccountEdit from 'core/account-edit';
import AccountEditAvatar from 'core/account-edit-avatar';
import AccountEditBlocklist from 'core/account-edit-blocklist';
import AnimateNav from 'core/animate-nav';
import BbcodeAutoPreview from 'core/bbcode-auto-preview';
import BladePopup from 'core/blade-popup';
import BrowserTitleWithNotificationCount from 'core/browser-title-with-notification-count';
import Captcha from 'core/captcha';
import ChangelogChartLoader from 'core/changelog-chart-loader';
import ClickMenu from 'core/click-menu';
import CurrentUserObserver from 'core/current-user-observer';
import Enchant from 'core/enchant';
import ForumPoll from 'core/forum/forum-poll';
import ForumPostEdit from 'core/forum/forum-post-edit';
import ForumPostInput from 'core/forum/forum-post-input';
import ForumPostReport from 'core/forum/forum-post-report';
import ForumTopicTagEditor from 'core/forum/forum-topic-tag-editor';
import Localtime from 'core/localtime';
import MobileToggle from 'core/mobile-toggle';
import OsuAudio from 'core/osu-audio/main';
import ReactTurbolinks from 'core/react-turbolinks';
import Spoilerbox from 'core/spoilerbox';
import StickyFooter from 'core/sticky-footer';
import StickyHeader from 'core/sticky-header';
import SyncHeight from 'core/sync-height';
import Timeago from 'core/timeago';
import TurbolinksReload from 'core/turbolinks-reload';
import TwitchPlayer from 'core/twitch-player';
import ScorePins from 'core/user/score-pins';
import UserLogin from 'core/user/user-login';
import UserLoginObserver from 'core/user/user-login-observer';
import UserModel from 'core/user/user-model';
import UserPreferences from 'core/user/user-preferences';
import UserVerification from 'core/user/user-verification';
import ReferenceLinkTooltip from 'core/wiki/reference-link-tooltip';
import WindowFocusObserver from 'core/window-focus-observer';
import WindowSize from 'core/window-size';
import type CurrentUserJson from 'interfaces/current-user-json';
import { action, computed, makeObservable, observable } from 'mobx';
import NotificationsWorker from 'notifications/worker';
import SocketWorker from 'socket-worker';
import RootDataStore from 'stores/root-data-store';
import { parseJsonNullable } from 'utils/json';
import UserTagPickerController from './beatmaps/user-tag-picker-controller';

// will this replace main.coffee eventually?
export default class OsuCore {
  readonly accountEdit;
  readonly accountEditAvatar;
  readonly accountEditBlocklist;
  readonly animateNav;
  readonly bbcodeAutoPreview;
  readonly beatmapsetSearchController;
  readonly beatmapTagPickerController;
  readonly bladePopup;
  readonly browserTitleWithNotificationCount;
  readonly captcha;
  readonly changelogChartLoader;
  readonly chatWorker;
  readonly clickMenu;
  @observable currentUser?: CurrentUserJson;
  readonly currentUserModel;
  readonly currentUserObserver;
  readonly dataStore;
  readonly enchant;
  firstCurrentUserSet = false;
  readonly forumPoll;
  readonly forumPostEdit;
  readonly forumPostInput;
  readonly forumPostReport;
  readonly forumTopicTagEditor;
  readonly localtime;
  readonly mobileToggle;
  readonly notificationsWorker;
  readonly osuAudio;
  readonly reactTurbolinks;
  readonly referenceLinkTooltip;
  readonly scorePins;
  readonly socketWorker;
  readonly spoilerbox;
  readonly stickyFooter;
  readonly stickyHeader;
  readonly syncHeight;
  readonly timeago;
  readonly turbolinksReload;
  readonly twitchPlayer;
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
    // This needs to be fired before everything else (turbo:load etc).
    $.subscribe('user:update', this.onCurrentUserUpdate);

    this.animateNav = new AnimateNav();
    this.bbcodeAutoPreview = new BbcodeAutoPreview();
    this.bladePopup = new BladePopup();
    this.captcha = new Captcha();
    this.changelogChartLoader = new ChangelogChartLoader();
    this.chatWorker = new ChatWorker();
    this.clickMenu = new ClickMenu();
    this.currentUserObserver = new CurrentUserObserver(this);
    this.currentUserModel = new UserModel(this);
    this.forumPoll = new ForumPoll();
    this.forumPostEdit = new ForumPostEdit();
    this.forumPostInput = new ForumPostInput();
    this.forumPostReport = new ForumPostReport();
    this.forumTopicTagEditor = new ForumTopicTagEditor();
    this.localtime = new Localtime();
    this.mobileToggle = new MobileToggle();
    this.browserTitleWithNotificationCount = new BrowserTitleWithNotificationCount(this);
    this.referenceLinkTooltip = new ReferenceLinkTooltip();
    this.scorePins = new ScorePins();
    this.spoilerbox = new Spoilerbox();
    this.stickyFooter = new StickyFooter();
    this.stickyHeader = new StickyHeader();
    this.syncHeight = new SyncHeight();
    this.timeago = new Timeago();
    this.turbolinksReload = new TurbolinksReload();
    this.userPreferences = new UserPreferences();
    this.userVerification = new UserVerification();
    this.windowSize = new WindowSize();

    this.enchant = new Enchant(this.turbolinksReload);
    this.osuAudio = new OsuAudio(this.userPreferences);
    this.reactTurbolinks = new ReactTurbolinks(this, this.turbolinksReload);
    this.twitchPlayer = new TwitchPlayer(this.turbolinksReload);

    this.userLogin = new UserLogin(this.captcha);
    // should probably figure how to conditionally or lazy initialize these so they don't all init when not needed.
    // TODO: requires dynamic imports to lazy load modules.
    this.dataStore = new RootDataStore();
    this.accountEditBlocklist = new AccountEditBlocklist(this);
    this.accountEdit = new AccountEdit(this);
    this.accountEditAvatar = new AccountEditAvatar(this);
    this.userLoginObserver = new UserLoginObserver();
    this.windowFocusObserver = new WindowFocusObserver();

    this.beatmapsetSearchController = new BeatmapsetSearchController(this.dataStore.beatmapsetSearch);
    this.beatmapTagPickerController = new UserTagPickerController();

    this.socketWorker = new SocketWorker();
    this.notificationsWorker = new NotificationsWorker(this.socketWorker);

    makeObservable(this);
  }

  @action
  readonly setCurrentUser = (userOrEmpty: typeof window.currentUser) => {
    const user = userOrEmpty.id == null ? undefined : userOrEmpty;

    if (user != null) {
      this.dataStore.userStore.update(user);
    }
    this.socketWorker.setUserId(user?.id ?? null);
    this.currentUser = user;
    window.currentUser = userOrEmpty;
    this.userPreferences.setUser(this.currentUser);
  };

  readonly updateCurrentUser = () => {
    // Remove from DOM so only new data is parsed on navigation.
    const currentUser = parseJsonNullable<typeof window.currentUser>('json-current-user', true);

    if (currentUser != null) {
      this.setCurrentUser(currentUser);
    }
  };

  private readonly onCurrentUserUpdate = (event: unknown, user: CurrentUserJson) => {
    this.setCurrentUser(user);
  };
}
