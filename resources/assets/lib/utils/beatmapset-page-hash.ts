// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJson from 'interfaces/beatmap-json';

function getInt(num: unknown) {
  let ret: number | undefined;

  if (typeof num === 'number') {
    ret = num;
  } else if (typeof num === 'string') {
    ret = parseInt(num, 10);
  }

  if (Number.isFinite(ret)) return ret;
}

export function parse(hash: string) {
  const [mode, id] = hash.slice(1).split('/');

  return {
    beatmapId: getInt(id),
    playmode: osu.presence(mode),
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
