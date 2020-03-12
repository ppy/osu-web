// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.
import OsuCore from 'osu-core';

declare global {
  interface Window {
    OsuCore: OsuCore;
  }
}

const core = new OsuCore(window);
window.OsuCore = core; // for debugging

export default core;
