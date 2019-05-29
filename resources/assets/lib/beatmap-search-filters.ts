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

import { computed, observable } from 'mobx';

export interface BeatmapSearchParams {
  extra: string | null;
  general: string | null;
  genre: string | null;
  language: string | null;
  mode: string | null;
  played: string | null;
  query: string | null;
  rank: string | null;
  sort: string | null;
  status: string | null;

  [index: string]: string | null;
}

export class BeatmapSearchFilters {
  @observable extra?: string;
  @observable general?: string;
  @observable genre?: string;
  @observable language?: string;
  @observable mode?: string;
  @observable played?: string;
  @observable rank?: string;
  @observable sort?: string;
  @observable status?: string;

  // tslint:disable-next-line:variable-name
  @observable private _query: string | null = null; // initialized to null because undefined -> null is considered a change

  constructor(url: string) {
    const filters = BeatmapsetFilter.filtersFromUrl(url);
    // tslint:disable-next-line:prefer-const browsers that support ES6 but not const in for...of
    for (let key of Object.keys(filters)) {
      (this as any)[key] = filters[key]; // FIXME: indexer
    }
  }

  get displaySort() {
    return this.selectedValue('sort');
  }

  @computed
  get query() {
    return this._query;
  }

  set query(value: string | null) {
    if (osu.presence(value) === osu.presence(this._query)) {
      return;
    }

    if (value != null) {
      this._query = osu.presence(value.trim());
    }
  }

  get queryParams() {
    const values = this.values;

    return BeatmapsetFilter.queryParamsFromFilters(values);
  }

  /**
   * Returns a copy of the values in the filter.
   */
  get values() {
    // Object.assign doesn't copy the methods
    const values = Object.assign({}, this);
    values.query = this._query;
    delete values._query;

    return values;
  }

  selectedValue(key: string) {
    const value = (this as any)[key]; // FIXME: indexer
    if (value == null) {
      return BeatmapsetFilter.getDefault(this.values, key);
    }

    return value;
  }

  toKeyString() {
    const values = this.values;

    const normalized = BeatmapsetFilter.fillDefaults(values) as any;
    const parts = [];
    for (const key of Object.keys(normalized)) {
      parts.push(`${key}=${normalized[key]}`);
    }

    return parts.join('&');
  }

  update(newFilters: Partial<BeatmapSearchParams>) {
    if (newFilters.query !== undefined && newFilters.query !== this.query
      || newFilters.status !== undefined && newFilters.status !== this.status) {
      this.sort = undefined;
    }

    // tslint:disable-next-line:prefer-const browsers that support ES6 but not const in for...of
    for (let key of Object.keys(newFilters)) {
      (this as any)[key] = newFilters[key]; // FIXME: indexer
    }
  }
}
