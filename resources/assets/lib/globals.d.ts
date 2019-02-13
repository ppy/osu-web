declare var window: Window;

// libraries
declare var _: any;
declare var laroute: any;
declare var moment: any;

// our helpers
declare var tooltipDefault: TooltipDefault;
declare var osu: OsuCommon;
declare var currentUser: any;
declare var reactTurbolinks: any;

// external (to typescript) react components
declare var BigButton: any;
declare var Comments: any;
declare var CommentsManager: any;
declare var Img2x: any;
declare var ShowMoreLink: any;
declare var Spinner: any;
declare var Timeout: any;
declare var UserAvatar: any;

// Global object types
interface Comment {
  id: number;
}

interface JQueryStatic {
  subscribe: any;
  unsubscribe: any;
  publish: any;
}

interface OsuCommon {
  ajaxError: (xhr: JQueryXHR) => void;
  classWithModifiers: (baseName: string, modifiers?: string[]) => string;
  jsonClone: (obj: any) => any;
  parseJson: (id: string) => any;
  timeago: (time: string) => string;
  trans: (...args: any[]) => string;
  urlPresence: (url: string) => string;
  uuid: () => string;
}

interface User {
  id: number;
  username: string;
}

interface TooltipDefault {
  remove: (el: HTMLElement) => void;
}
