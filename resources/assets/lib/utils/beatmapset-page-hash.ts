// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJson from 'interfaces/beatmap-json';
import GameMode, { ensureGameMode } from 'interfaces/game-mode';
import { getInt } from './math';
import { currentUrl } from './turbolinks';

export function parse(hash: string) {
  const [mode, id] = hash.slice(1).split('/');

  return {
    beatmapId: getInt(id),
    playmode: ensureGameMode(mode),
  };
}

export function generate({ beatmap, ruleset }: { beatmap?: BeatmapJson; ruleset?: GameMode }) {
  let hash = '';

  ruleset ??= beatmap?.mode;
  if (ruleset != null) {
    hash += `#${ruleset}`;

    if (beatmap != null) {
      hash += `/${beatmap.id}`;
    }
  }

  return hash;
}

export function setHash(newHash: string) {
  const currUrl = currentUrl().href;
  const newUrl = `${currUrl.replace(/#.*/, '')}${newHash}`;

  if (newUrl === currUrl) return;

  history.replaceState(history.state, '', newUrl);
}
