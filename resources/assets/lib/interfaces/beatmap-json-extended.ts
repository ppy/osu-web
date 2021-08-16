// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJson from './beatmap-json';

export function isValid(x: BeatmapJson | BeatmapJsonExtended): x is BeatmapJsonExtended {
  return (x as BeatmapJsonExtended).accuracy != null;
}

// TODO: incomplete
export default interface BeatmapJsonExtended extends BeatmapJson {
  accuracy: number;
  ar: number;
  convert: boolean | null;
  count_circles: number;
  count_sliders: number;
  count_spinners: number;
  cs: number;
  deleted_at: string | null;
  drain: number;
  failtimes?: BeatmapFailTimesArray;
  hit_length: number;
  last_updated: string;
  mode_int: number;
  passcount: number;
  playcount: number;
  ranked: number;
  status: string;
  total_length: number;
  url: string;
}
