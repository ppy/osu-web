// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Lang from 'lang.js';
import './../js/ga.js'; // FIXME: fix lookup path

declare global {
  interface Window {
    Lang: Lang;
  }
}

if (window.Lang !== undefined) {
  // existing locale data loaded first
  const existing = window.Lang as any; // FIXME: messages key

  window.Lang = new Lang({
    messages: existing.messages,
  });
} else {
  window.Lang = new Lang({ messages: {} });
}
