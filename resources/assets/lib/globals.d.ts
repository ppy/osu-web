// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

interface Window {
  newBody?: HTMLElement;
  newUrl?: URL | Location | null;
}

// interfaces for using process.env
interface Process {
  env: ProcessEnv;
}

interface ProcessEnv {
  [key: string]: string | undefined;
}

declare const process: Process;

// TODO: Turbolinks 5.3 is Typescript, so this should be updated then.
declare const Turbolinks: import('turbolinks').default;

// our helpers
declare const tooltipDefault: TooltipDefault;
declare const osu: OsuCommon;
declare const currentUser: import('interfaces/current-user').default;

// external (to typescript) classes
declare const BeatmapsetFilter: import('interfaces/beatmapset-filter-class').default;
declare const BeatmapDiscussionHelper: BeatmapDiscussionHelperClass;
declare const LoadingOverlay: any;
declare const Lang: LangClass;
declare const fallbackLocale: string;
declare const currentLocale: string;

// Global object types
interface Comment {
  id: number;
}

interface BeatmapDiscussionHelperClass {
  format(text: string, options?: any): string;
  formatTimestamp(value: number | null): string | undefined;
  nearbyDiscussions(discussions: BeatmapsetDiscussionJson[], timestamp: number): BeatmapsetDiscussionJson[];
  parseTimestamp(value?: string): number | null;
  previewMessage(value: string): string;
  TIMESTAMP_REGEX: RegExp;
  url(options: any, useCurrent?: boolean): string;
  urlParse(urlString: string, discussions?: BeatmapsetDiscussionJson[] | null, options?: any): {
    beatmapId?: number;
    beatmapsetId?: number;
    discussionId?: number;
    filter: string;
    mode: string;
    postId?: number;
    user?: number;
  };
}

interface JQueryStatic {
  publish: (eventName: string, data?: any) => void;
  subscribe: (eventName: string, handler: (...params: any[]) => void) => void;
  unsubscribe: (eventName: string, handler?: unknown) => void;
}

type AjaxError = (xhr: JQuery.jqXHR) => void;

interface OsuCommon {
  ajaxError: AjaxError;
  formatBytes: (bytes: number, decimals?: number) => string;
  formatNumber(num: null, precision?: number, options?: Intl.NumberFormatOptions, locale?: string): null;
  formatNumber(num: number, precision?: number, options?: Intl.NumberFormatOptions, locale?: string): string;
  groupColour: (group?: import('interfaces/group-json').default) => React.CSSProperties;
  isClickable: (el: HTMLElement) => boolean;
  link: (url: string, text: string, options?: import('utils/url').OsuLinkOptions) => string;
  navigate: (url: string, keepScroll?: boolean, action?: Partial<Record<string, unknown>>) => void;
  popup: (message: string, type: string) => void;
  popupShowing: () => boolean;
  presence: (str?: string | null) => string | null;
  present: (str?: string | null) => boolean;
  promisify: (xhr: JQuery.jqXHR) => Promise<any>;
  reloadPage: () => void;
  trans: (...args: any[]) => string;
  transArray: (array: any[], key?: string) => string;
  transChoice: (key: string, count: number, replacements?: any, locale?: string) => string;
  transExists: (key: string, locale?: string) => boolean;
  urlPresence: (url?: string | null) => string;
  urlRegex: RegExp;
  uuid: () => string;
  xhrErrorMessage: (xhr: JQuery.jqXHR) => string;
}

interface ChangelogBuild {
  update_stream: {
    name: string;
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
  custom_url: string | null;
  id: string | null;
  url: string | null;
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
  message_type: import('beatmap-discussions/discussion-type').DiscussionType;
  parent_id: number | null;
  posts: BeatmapsetDiscussionPostJson[];
  resolved: boolean;
  starting_post: BeatmapsetDiscussionPostJson;
  timestamp: number | null;
  user_id: number;
}

// TODO: incomplete
interface BeatmapsetDiscussionPostJson {
  message: string;
}

interface TooltipDefault {
  remove: (el: HTMLElement) => void;
}
