// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetSearchParams, FilterKey } from 'beatmapset-search-filters';

export default interface BeatmapsetFilterClass {
  defaults: Record<string, string | null>;
  filtersFromUrl(url: string): Partial<BeatmapsetSearchParams>;
  getDefault(filters: Partial<BeatmapsetSearchParams>, key: string): string | number | null;
  supporterRequired(filters: Partial<BeatmapsetSearchParams>): FilterKey[];
}
