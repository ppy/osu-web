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

import { action, computed, observable } from 'mobx';

type filterValueType = string | null;

export interface BeatmapSearchParams {
  extra: filterValueType;
  general: filterValueType;
  genre: filterValueType;
  language: filterValueType;
  mode: filterValueType;
  played: filterValueType;
  query: filterValueType;
  rank: filterValueType;
  sort: filterValueType;
  status: filterValueType;

  [key: string]: any;
}

export class BeatmapSearchFilters implements BeatmapSearchParams {
  @observable extra: filterValueType = null;
  @observable general: filterValueType = null;
  @observable genre: filterValueType = null;
  @observable language: filterValueType = null;
  @observable mode: filterValueType = null;
  @observable played: filterValueType = null;
  @observable rank: filterValueType = null;
  @observable sort: filterValueType = null;
  @observable status: filterValueType = null;
  @observable private sanitizedQuery: filterValueType = null;

  [key: string]: any;

  constructor(url: string) {
    const filters = BeatmapsetFilter.filtersFromUrl(url);
    // tslint:disable-next-line:prefer-const browsers that support ES6 but not const in for...of
    for (let key of Object.keys(filters)) {
      this[key] = filters[key];
    }
  }

  @computed
  get displaySort() {
    return this.selectedValue('sort');
  }

  @computed
  get query() {
    return this.sanitizedQuery;
  }

  set query(value: string | null) {
    if (osu.presence(value) === osu.presence(this.sanitizedQuery)) {
      return;
    }

    if (value != null) {
      this.sanitizedQuery = osu.presence(value.trim());
    }
  }

  @computed
  get queryParams() {
    const values = this.values;

    return BeatmapsetFilter.queryParamsFromFilters(values);
  }

  selectedValue(key: string) {
    const value = this[key];
    if (value == null) {
      return BeatmapsetFilter.getDefault(this.values, key);
    }

    return value;
  }

  toKeyString() {
    const values = this.values;

    const normalized = BeatmapsetFilter.fillDefaults(values) as any;
    const parts = [];
    // tslint:disable-next-line:prefer-const browsers that support ES6 but not const in for...of
    for (let key of Object.keys(normalized)) {
      parts.push(`${key}=${normalized[key]}`);
    }

    return parts.join('&');
  }

  @action
  update(newFilters: Partial<BeatmapSearchParams>) {
    if (newFilters.query !== undefined && newFilters.query !== this.query
      || newFilters.status !== undefined && newFilters.status !== this.status) {
      this.sort = null;
    }

    // tslint:disable-next-line:prefer-const browsers that support ES6 but not const in for...of
    for (let key of Object.keys(newFilters)) {
      this[key] = newFilters[key];
    }
  }

  /**
   * Returns a copy of the values in the filter.
   */
  @computed
  private get values() {
    // Object.assign doesn't copy the methods
    const values = Object.assign({}, this);
    values.query = this.sanitizedQuery;
    delete values.sanitizedQuery;

    return values as BeatmapSearchParams;
  }
}
