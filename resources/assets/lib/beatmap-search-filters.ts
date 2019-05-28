/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

export interface BeatmapSearchFilters {
  extra: string;
  general: string;
  genre: string | null;
  language: string | null;
  mode: string | null;
  played: string | null;
  query: string;
  rank: string;
  sort?: string | null;
  status: number;
}

export class SearchFilters {
  extra?: string;
  general?: string;
  genre?: string;
  language?: string;
  mode?: string;
  played?: string;
  query?: string;
  rank?: string;
  sort?: string = 'ranked_desc';
  status?: number;

  [index: string]: unknown;

  constructor(url: string) {
    const filters = BeatmapsetFilter.filtersFromUrl(url);
    // tslint:disable-next-line:prefer-const browsers that support ES6 but not const in for...of
    for (let key of Object.keys(filters)) {
      this[key] = filters[key];
    }
  }

  get queryParams() {
    return BeatmapsetFilter.queryParamsFromFilters(this);
  }
}
