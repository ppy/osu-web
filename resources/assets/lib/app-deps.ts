// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Lang from 'lang.js';

declare global {
  interface Window {
    Lang: Lang;
    LangMessages: unknown;
  }
}

window.LangMessages ??= {};
window.Lang = new Lang({ messages: window.LangMessages });
