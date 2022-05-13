// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJson from 'interfaces/beatmap-json';
import { ensureGameMode } from 'interfaces/game-mode';
import { getInt } from './math';
import { currentUrl } from './turbolinks';

export function parse(hash: string) {
  const [mode, id] = hash.slice(1).split('/');

  return {
    beatmapId: getInt(id),
    playmode: ensureGameMode(mode),
  };
}

export function generate({ beatmap, mode }: { beatmap?: BeatmapJson; mode?: string }) {
  if (beatmap != null) {
    return `#${beatmap.mode}/${beatmap.id}`;
  }

  if (mode != null) {
    return `#${mode}`;
  }

  return '';
}

export function setHash(newHash: string) {
  const currUrl = currentUrl().href;
  const newUrl = `${currUrl.replace(/#.*/, '')}${newHash}`;

  if (newUrl === currUrl) return;

  history.replaceState(history.state, '', newUrl);
}
