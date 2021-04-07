// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetSearchParams, FilterKey } from 'beatmapset-search-filters';

export default interface BeatmapsetFilterClass {
  expand: ['genre', 'language', 'extra', 'rank', 'played'];
  fillDefaults(filters: Partial<Record<string, any>>): BeatmapsetSearchParams;
  filtersFromUrl(url: string): Partial<BeatmapsetSearchParams>;
  getDefault(filters: Partial<BeatmapsetSearchParams>, key: string): string;
  queryParamsFromFilters(filters: Partial<BeatmapsetSearchParams>): Partial<Record<string, any>>;
  supporterRequired(filters: Partial<BeatmapsetSearchParams>): FilterKey[];
}
