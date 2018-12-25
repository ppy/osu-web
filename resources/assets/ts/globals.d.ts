declare var window: Window;
// libraries
declare var _: any;
declare var laroute: any;
declare var moment: any;

// our helpers
declare var osu: OsuCommon;
declare var currentUser: any;
declare var reactTurbolinks: any;
// external (to typescript) react components
declare var BigButton: any;
declare var Img2x: any;
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
  trans: (...args: any[]) => string;
  uuid: () => string;
  parseJson: (id: string) => any;
}

interface User {
  id: number;
  username: string;
}
