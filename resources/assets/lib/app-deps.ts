// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import CurrentUserJson from 'interfaces/current-user-json';

// import jquery + plugins
import * as $ from 'jquery';
import 'jquery-ujs';
import 'bootstrap';
import 'timeago/jquery.timeago.js';
import 'qtip2/dist/jquery.qtip.js';
import 'jquery.scrollto/jquery.scrollTo.js';
import 'jquery-ui/ui/data.js';
import 'jquery-ui/ui/widgets/slider.js';
import 'jquery-ui/ui/widgets/sortable.js';
import 'blueimp-file-upload/js/jquery.fileupload.js';

import { patchPluralHandler } from 'lang-overrides';
import Lang from 'lang.js';
import { configure as mobxConfigure } from 'mobx';
import * as moment from 'moment';
import Turbolinks from 'turbolinks';

interface SharedStyles {
  header: {
    height: number;
    heightMobile: number;
    heightSticky: number;
  };
}

declare global {
  interface Window {
    $: any;
    _styles: SharedStyles;
    currentLocale: string;
    currentUser: CurrentUserJson | { id: undefined };
    fallbackLocale: string;
    jQuery: any;
    Lang: Lang;
    LangMessages: unknown;
    moment: any;
    Turbolinks: Turbolinks;
  }
}

window.$ = $;
window.jQuery = $;
window.LangMessages ??= {};
window.Lang = patchPluralHandler(new Lang({
  fallback: window.fallbackLocale,
  locale: window.currentLocale,
  messages: window.LangMessages,
}));
window.moment = moment;
window.Turbolinks = Turbolinks;

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
