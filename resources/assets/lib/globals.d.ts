// interfaces for using process.env
interface Process {
  env: ProcessEnv;
}

interface ProcessEnv {
  [key: string]: string | undefined;
}

declare var process: Process;

declare var window: Window;

// TODO: Turbolinks 5.3 is Typescript, so this should be updated then.
declare var Turbolinks: TurbolinksStatic;

// our helpers
declare var tooltipDefault: TooltipDefault;
declare var osu: OsuCommon;
declare var currentUser: any;
declare var reactTurbolinks: any;
declare var userVerification: any;

// external (to typescript) classes
declare var BeatmapsetFilter: any;
declare var BeatmapHelper: BeatmapHelperInterface;
declare var BeatmapDiscussionHelper: BeatmapDiscussionHelperClass;
declare var LoadingOverlay: any;
declare var Timeout: any;
declare const Lang: LangClass;

// Global object types
interface Comment {
  id: number;
}

interface DiscussionMessageType {
  icon: {[key: string]: string};
  iconText: {[key: string]: string[]};
}

interface BeatmapDiscussionHelperClass {
  messageType: DiscussionMessageType;
  format(text: string, options?: any): string;
  formatTimestamp(value: number): string;
  url(options: any, useCurrent?: boolean): string;
}

interface JQueryStatic {
  publish: (eventName: string, data?: any) => void;
  subscribe: (eventName: string, handler: (...params: any[]) => void) => void;
  unsubscribe: (eventName: string) => void;
}

interface OsuCommon {
  ajaxError: (xhr: JQueryXHR) => void;
  classWithModifiers: (baseName: string, modifiers?: string[]) => string;
  groupColour: (group?: GroupJSON) => React.CSSProperties;
  isClickable: (el: HTMLElement) => boolean;
  jsonClone: (obj: any) => any;
  link: (url: string, text: string, options?: { classNames?: string[]; isRemote?: boolean }) => string;
  linkify: (text: string, newWindow?: boolean) => string;
  navigate: (url: string, keepScroll?: boolean, action?: object) => void;
  parseJson: (id: string, remove?: boolean) => any;
  popup: (message: string, type: string) => void;
  popupShowing: () => boolean;
  presence: (str?: string | null) => string | null;
  present: (str?: string | null) => boolean;
  promisify: (xhr: JQueryXHR) => Promise<any>;
  timeago: (time?: string) => string;
  trans: (...args: any[]) => string;
  transArray: (array: any[], key?: string) => string;
  transChoice: (key: string, count: number, replacements?: any, locale?: string) => string;
  transExists: (key: string, locale?: string) => boolean;
  urlPresence: (url?: string | null) => string;
  uuid: () => string;
  formatNumber(num: number, precision?: number, options?: Intl.NumberFormatOptions, locale?: string): string;
  formatNumber(num: null, precision?: number, options?: Intl.NumberFormatOptions, locale?: string): null;
  isDesktop(): boolean;
  isMobile(): boolean;
  updateQueryString(url: string | null, params: { [key: string]: string | undefined }): string;
}

interface BeatmapHelperInterface {
  getDiffRating(rating: number): string;
}

interface ChangelogBuild {
  update_stream: {
    name: string,
  };
  version: string;
}

interface Country {
  code?: string;
  name?: string;
}

interface Cover {
  custom_url?: string;
  id?: string;
  url?: string;
}

interface Score {
  id: string;
  mode: string;
  replay: boolean;
  user: User;
  user_id: number;
}

interface BeatmapFailTimesArray {
  exit: number[];
  fail: number[];
}

// TODO: incomplete
interface Beatmap {
  accuracy: number;
  ar: number;
  beatmapset_id: number;
  convert: boolean | null;
  count_circles: number;
  count_sliders: number;
  count_spinners: number;
  count_total: number;
  cs: number;
  deleted_at: string | null;
  difficulty_rating: number;
  drain: number;
  failtimes?: BeatmapFailTimesArray;
  hit_length: number;
  id: number;
  last_updated: string;
  mode: string;
  mode_int: number;
  passcount: number;
  playcount: number;
  ranked: number;
  status: string;
  total_length: number;
  url: string;
  version: string;
}

// TODO: incomplete
interface BeatmapDiscussion {
  beatmap_id: number | null;
  beatmapset_id: number;
  message_type: string;
  parent_id: number | null;
  posts: BeatmapDiscussionPost[];
  resolved: boolean;
  starting_post: BeatmapDiscussionPost;
  timestamp: number | null;
}

// TODO: incomplete
interface BeatmapDiscussionPost {
  message: string;
}

interface LangClass {
  _getPluralForm: (count: number) => number;
  _origGetPluralForm: (count: number) => number;
  locale: string;
}

// TODO: should look at combining with the other User.ts at some point.
interface User {
  avatar_url?: string;
  country?: Country;
  country_code?: string;
  cover: Cover;
  current_mode_rank?: number;
  default_group: string;
  follower_count?: number;
  group_badge?: GroupJSON;
  id: number;
  is_active: boolean;
  is_bot: boolean;
  is_online: boolean;
  is_supporter: boolean;
  last_visit?: string;
  pm_friends_only: boolean;
  profile_colour?: string;
  support_level?: number;
  unread_pm_count?: number;
  username: string;
}

interface TooltipDefault {
  remove: (el: HTMLElement) => void;
}

interface TurbolinksAction {
  action: 'advance' | 'replace' | 'restore';
}

interface TurbolinksLocation {
    getPath(): string;
    isHTML(): boolean;
}

interface TurbolinksStatic {
  controller: any;
  supported: boolean;

  clearCache(): void;
  setProgressBarDelay(delayInMilliseconds: number): void;
  uuid(): string;
  visit(location: string, options?: TurbolinksAction): void;
}
