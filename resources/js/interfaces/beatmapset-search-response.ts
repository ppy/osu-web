// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';

type SortField = 'artist' | 'difficulty' | 'favourites' | 'plays' | 'ranked' | 'rating' | 'relevance' | 'title';
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
