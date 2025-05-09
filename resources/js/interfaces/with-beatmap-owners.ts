// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJson from './beatmap-json';

type WithBeatmapOwners<T extends BeatmapJson> = T & Required<Pick<T, 'owners'>>;

export function hasOwners<T extends BeatmapJson>(beatmap: T): beatmap is WithBeatmapOwners<T> {
  return beatmap.owners != null;
}

export default WithBeatmapOwners;
