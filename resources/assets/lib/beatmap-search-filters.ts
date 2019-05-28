import { observable } from 'mobx';

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
  status: string;

  [index: string]: unknown;
}

export class SearchFilters {
  @observable extra?: string;
  @observable general?: string;
  @observable genre?: string;
  @observable language?: string;
  @observable mode?: string;
  @observable played?: string;
  @observable query?: string;
  @observable rank?: string;
  @observable sort?: string;
  @observable status?: string;

  // TODO: visible values should be different from internal values
  constructor(url: string) {
    const filters = BeatmapsetFilter.filtersFromUrl(url);
    // tslint:disable-next-line:prefer-const browsers that support ES6 but not const in for...of
    for (let key of Object.keys(filters)) {
      (this as any)[key] = filters[key];
    }
  }

  get displaySort() {
    return this.selectedValue('sort');
  }

  get queryParams() {
    const values = this.values;
    values.query = this.queryForSearch;

    return BeatmapsetFilter.queryParamsFromFilters(values);
  }

  get queryForSearch() {
    if (this.query != null) {
      return this.query.trim();
    }
  }

  get values() {
    // Object.assign doesn't copy the methods
    return Object.assign({}, this);
  }

  selectedValue(key: string) {
    const value = (this as any)[key];
    if (value == null) {
      return BeatmapsetFilter.getDefault(this.values, key);
    }

    return value;
  }

  toKeyString() {
    const values = this.values;
    values.query = this.queryForSearch;

    const normalized = BeatmapsetFilter.fillDefaults(values) as any;
    const parts = [];
    for (const key of Object.keys(normalized)) {
      parts.push(`${key}=${normalized[key]}`);
    }

    return parts.join('&');
  }

  update(newFilters: Partial<BeatmapSearchFilters>) {
    // TODO: explicitly compare with undefined?
    if (newFilters.query != null && newFilters.query !== this.query
      || newFilters.status != null && newFilters.query !== this.status) {
      this.sort = undefined;
    }

    // tslint:disable-next-line:prefer-const browsers that support ES6 but not const in for...of
    for (let key of Object.keys(newFilters)) {
      (this as any)[key] = newFilters[key];
    }
  }
}
