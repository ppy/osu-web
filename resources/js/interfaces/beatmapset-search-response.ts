// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';

// order the sorters appear in.
export const sortNames = ['title', 'artist', 'difficulty', 'updated', 'ranked', 'rating', 'plays', 'favourites', 'relevance', 'nominations'] as const;
export type SortField = typeof sortNames[number];
type SortOrder = 'asc' | 'desc';
type Sort = `${SortField}_${SortOrder}`;

export default interface BeatmapsetSearchResponse {
  beatmapsets: BeatmapsetExtendedJson[];
  cursor_string: string | null;
  error?: string;
  recommended_difficulty: number;
  search: {
    sort: Sort;
  };
  total: number;
}
