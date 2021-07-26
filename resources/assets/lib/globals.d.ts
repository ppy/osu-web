// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

interface Window {
  newBody?: HTMLElement;
  newUrl?: URL | Location | null;
  reloadUrl?: string | null;
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

interface DiscussionMessageType {
  icon: { [key: string]: string };
}

interface BeatmapDiscussionHelperClass {
  messageType: DiscussionMessageType;
  TIMESTAMP_REGEX: RegExp;
  format(text: string, options?: any): string;
  formatTimestamp(value: number | null): string | undefined;
  nearbyDiscussions(discussions: BeatmapsetDiscussionJson[], timestamp: number): BeatmapsetDiscussionJson[];
  parseTimestamp(value?: string): number | null;
  previewMessage(value: string): string;
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

interface OsuLinkOptions {
  classNames?: string[];
  isRemote?: boolean;
  props?: Partial<Record<string, any>>;
  unescape?: boolean;
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
  message_type: string;
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

interface LangClass {
  _getPluralForm: (count: number, locale: string) => number;
  _origGetPluralForm: (count: number, locale: string) => number;
  choice(key: string, count: number, replacements?: Record<string, unknown> | null, locale?: string): string;
  get(key: string, replacements?: Record<string, unknown> | null, locale?: string): string;
  has(key: string): boolean;
}

interface TooltipDefault {
  remove: (el: HTMLElement) => void;
}
