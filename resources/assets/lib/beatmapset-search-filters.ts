// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { action, computed, intercept, observable } from 'mobx';

const keyNames = ['extra', 'general', 'genre', 'language', 'mode', 'nsfw', 'played', 'query', 'rank', 'sort', 'status'] as const;
type Key = (typeof keyNames)[number];
type filterValueType = string | null;

// FIXME: the any typing is because the class has additional methods.
export interface BeatmapsetSearchParams extends Record<Key, any> {
  extra: filterValueType;
  general: filterValueType;
  genre: filterValueType;
  language: filterValueType;
  mode: filterValueType;
  nsfw: filterValueType;
  played: filterValueType;
  query: filterValueType;
  rank: filterValueType;
  sort: filterValueType;
  status: filterValueType;
}

export class BeatmapsetSearchFilters implements BeatmapsetSearchParams {
  @observable extra: filterValueType = null;
  @observable general: filterValueType = null;
  @observable genre: filterValueType = null;
  @observable language: filterValueType = null;
  @observable mode: filterValueType = null;
  @observable nsfw: filterValueType = null;
  @observable played: filterValueType = null;
  @observable query: filterValueType = null;
  @observable rank: filterValueType = null;
  @observable sort: filterValueType = null;
  @observable status: filterValueType = null;

  [key: string]: any;

  constructor(url: string) {
    const filters = BeatmapsetFilter.filtersFromUrl(url);
    for (const key of keyNames) {
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

  selectedValue(key: Key) {
    const value = this[key];
    if (value == null) {
      return BeatmapsetFilter.getDefault(this.values, key);
    }

    return value;
  }

  toKeyString() {
    const values = this.values;

    const normalized = BeatmapsetFilter.fillDefaults(values);
    const parts = [];
    for (const key of keyNames) {
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

    for (const key of keyNames) {
      this[key] = newFilters[key] ?? null;
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
