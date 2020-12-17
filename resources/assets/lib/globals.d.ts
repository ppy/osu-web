// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

type GroupJson = import('interfaces/group-json').default;

// interfaces for using process.env
interface Process {
  env: ProcessEnv;
}

interface ProcessEnv {
  [key: string]: string | undefined;
}

declare var process: Process;

// TODO: Turbolinks 5.3 is Typescript, so this should be updated then.
declare var Turbolinks: import('turbolinks').default;

// our helpers
declare var tooltipDefault: TooltipDefault;
declare var osu: OsuCommon;
declare var currentUser: import('interfaces/current-user').default;
declare var reactTurbolinks: any;
declare var userVerification: any;

// external (to typescript) classes
declare var BeatmapsetFilter: any;
declare var BeatmapDiscussionHelper: BeatmapDiscussionHelperClass;
declare var LoadingOverlay: any;
declare var Timeout: any;
declare const Lang: LangClass;
declare const fallbackLocale: string;
declare const currentLocale: string;

// Global object types
interface Comment {
  id: number;
}

interface DiscussionMessageType {
  icon: {[key: string]: string};
}

interface BeatmapDiscussionHelperClass {
  messageType: DiscussionMessageType;
  TIMESTAMP_REGEX: RegExp;
  format(text: string, options?: any): string;
  formatTimestamp(value: number | null): string | undefined;
  nearbyDiscussions(discussions: BeatmapsetDiscussionJson[], timestamp: number): BeatmapsetDiscussionJson[];
  parseTimestamp(value: string): number | null;
  previewMessage(value: string): string;
  url(options: any, useCurrent?: boolean): string;
}

interface JQueryStatic {
  publish: (eventName: string, data?: any) => void;
  subscribe: (eventName: string, handler: (...params: any[]) => void) => void;
  unsubscribe: (eventName: string) => void;
}

type AjaxError = (xhr: JQueryXHR) => void;

interface OsuCommon {
  ajaxError: AjaxError;
  classWithModifiers: (baseName: string, modifiers?: string[]) => string;
  diffColour: (difficultyRating?: string | null) => React.CSSProperties;
  emitAjaxError: (el?: HTMLElement | null) => AjaxError;
  groupColour: (group?: GroupJson) => React.CSSProperties;
  isClickable: (el: HTMLElement) => boolean;
  jsonClone: (obj: any) => any;
  link: (url: string, text: string, options?: { classNames?: string[]; isRemote?: boolean }) => string;
  linkify: (text: string, newWindow?: boolean) => string;
  navigate: (url: string, keepScroll?: boolean, action?: object) => void;
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
  urlRegex: RegExp;
  uuid: () => string;
  formatNumber(num: number, precision?: number, options?: Intl.NumberFormatOptions, locale?: string): string;
  formatNumber(num: null, precision?: number, options?: Intl.NumberFormatOptions, locale?: string): null;
  isDesktop(): boolean;
  isMobile(): boolean;
  parseJson<T = any>(id: string, remove?: boolean): T;
  updateQueryString(url: string | null, params: { [key: string]: string | null | undefined }): string;
}

interface ChangelogBuild {
  update_stream: {
    name: string,
  };
  version: string;
}

// FIXME: make importable
interface Country {
  code: string;
  display?: number;
  name: string;
}

interface Cover {
  custom_url?: string;
  id?: string;
  url?: string;
}

interface BeatmapFailTimesArray {
  exit: number[];
  fail: number[];
}

// TODO: incomplete
interface BeatmapsetDiscussionJson {
  beatmap_id: number | null;
  beatmapset_id: number;
  deleted_at: string | null;
  id: number;
  message_type: string;
  parent_id: number | null;
  posts: BeatmapsetDiscussionPostJson[];
  resolved: boolean;
  starting_post: BeatmapsetDiscussionPostJson;
  timestamp: number | null;
}

// TODO: incomplete
interface BeatmapsetDiscussionPostJson {
  message: string;
}

interface LangClass {
  _getPluralForm: (count: number, locale: string) => number;
  _origGetPluralForm: (count: number, locale: string) => number;
  has(key: string): boolean;
}

interface TooltipDefault {
  remove: (el: HTMLElement) => void;
}
