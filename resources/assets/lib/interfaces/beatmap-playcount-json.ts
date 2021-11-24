// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJson from './beatmap-extended-json';
import BeatmapsetJson from './beatmapset-extended-json';

export default interface BeatmapPlaycountJson {
  beatmap?: BeatmapJson;
  beatmap_id: number;
  beatmapset?: BeatmapsetJson;
  count: number;
}
