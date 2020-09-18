// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { action, computed, intercept, observable } from 'mobx';

type filterValueType = string | null;

export interface BeatmapsetSearchParams {
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

export class BeatmapsetSearchFilters implements BeatmapsetSearchParams {
  @observable extra: filterValueType = null;
  @observable general: filterValueType = null;
  @observable genre: filterValueType = null;
  @observable language: filterValueType = null;
  @observable mode: filterValueType = null;
  @observable played: filterValueType = null;
  @observable query: filterValueType = null;
  @observable rank: filterValueType = null;
  @observable sort: filterValueType = null;
  @observable status: filterValueType = null;

  [key: string]: any;

  constructor(url: string) {
    const filters = BeatmapsetFilter.filtersFromUrl(url);
    for (const key of Object.keys(filters)) {
      this[key] = filters[key];
    }

    intercept(this, 'query', (change) => {
      change.newValue = osu.presence((change.newValue as filterValueType)?.trim());

      return change;
    });
  }

  @computed
  get displaySort() {
    return this.selectedValue('sort');
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
    for (const key of Object.keys(normalized)) {
      parts.push(`${key}=${normalized[key]}`);
    }

    return parts.join('&');
  }

  @action
  update(newFilters: Partial<BeatmapsetSearchParams>) {
    if (newFilters.query !== undefined && newFilters.query !== this.query
      || newFilters.status !== undefined && newFilters.status !== this.status) {
      this.sort = null;
    }

    for (const key of Object.keys(newFilters)) {
      this[key] = newFilters[key];
    }
  }

  /**
   * Returns a copy of the values in the filter.
   */
  @computed
  private get values(): BeatmapsetSearchParams {
    return Object.assign({}, this);
  }
}
