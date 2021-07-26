// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as osu from 'osu-common';

declare global {
  interface Window {
    osu: typeof osu;
  }
}

// for legacy coffeescript
window.osu = osu;
