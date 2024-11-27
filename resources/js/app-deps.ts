// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import CurrentUserJson from 'interfaces/current-user-json';

import 'setup-turbo';

// import jquery + plugins
import 'setup-jquery';
// imported separately as it requires window jquery (setup by the import above)
import 'jquery-ujs';

import { patchPluralHandler } from 'lang-overrides';
import Lang from 'lang.js';
import { configure as mobxConfigure } from 'mobx';
import * as moment from 'moment';
import { popup } from 'utils/popup';
import { reloadPage } from 'utils/turbolinks';

interface SharedStyles {
  header: {
    height: number;
    heightMobile: number;
    heightSticky: number;
  };
}

// partial qtip2 typings
interface QTip2 {
  (...args: unknown[]): any;
  (method: 'api'): QTip2Api | undefined;
}

interface QTip2Api {
  destroy(immediate?: boolean): QTip2Api;
  hide(): QTip2Api;
  set(...args: unknown[]): QTip2Api;
  tooltip?: JQuery<HTMLElement>;
}

declare global {
  interface JQuery {
    qtip: QTip2;
  }

  interface HTMLElement {
    _tooltip?: string;
  }

  interface Window {
    $: JQueryStatic;
    _styles: SharedStyles;
    currentLocale: string;
    currentUser: CurrentUserJson | { id: undefined };
    experimentalHost: string | null;
    fallbackLocale: string;
    jQuery: JQueryStatic;
    Lang: Lang;
    LangMessages: unknown;
    moment: any;
    popup: typeof popup;
    reloadPage: typeof reloadPage;
  }
}

window.LangMessages ??= {};
window.Lang = patchPluralHandler(new Lang({
  fallback: window.fallbackLocale,
  locale: window.currentLocale,
  messages: window.LangMessages,
}));
window.moment = moment;
window.popup = popup;
window.reloadPage = reloadPage;

// refer to variables.less
window._styles = {
  header: {
    height: 90, // @nav2-height
    heightMobile: 50, // @navbar-height
    heightSticky: 50, // @nav2-height--pinned
  },
};

mobxConfigure({
  computedRequiresReaction: true,
});
