// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

// import jquery + plugins
import * as $ from 'jquery';
import 'jquery-ujs';
import 'bootstrap';
import 'timeago/jquery.timeago.js';
import 'qtip2/dist/jquery.qtip.js';
import 'jquery.scrollto/jquery.scrollTo.js';
import 'jquery-ui/ui/data.js';
import 'jquery-ui/ui/scroll-parent.js';
import 'jquery-ui/ui/widget.js';
import 'jquery-ui/ui/widgets/mouse.js';
import 'jquery-ui/ui/widgets/slider.js';
import 'jquery-ui/ui/widgets/sortable.js';
import 'jquery-ui/ui/keycode.js';
import 'blueimp-file-upload/js/jquery.fileupload.js';

import Lang from 'lang.js';
import * as moment from 'moment';
import Turbolinks from 'turbolinks';

declare global {
  interface Window {
    $: any;
    Lang: Lang;
    LangMessages: unknown;
    Turbolinks: Turbolinks;
    jQuery: any;
    moment: any;
  }
}

window.$ = $;
window.jQuery = $;
window.LangMessages ??= {};
window.Lang = new Lang({ messages: window.LangMessages });
window.moment = moment;
window.Turbolinks = Turbolinks;
