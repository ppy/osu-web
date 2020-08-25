// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Lang from 'lang.js';
import './../js/ga.js'; // FIXME: fix lookup path

declare global {
  interface Window {
    Lang: Lang;
  }
}

window.Lang = new Lang({});
window.Lang.setMessages({});
