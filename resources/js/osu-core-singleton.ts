// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.
import OsuCore from 'osu-core';

declare global {
  interface Window {
    osuCore: OsuCore;
  }
}

const core = new OsuCore();
window.osuCore = core; // for legacy and debugging

export default core;
