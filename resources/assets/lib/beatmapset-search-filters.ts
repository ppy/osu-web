// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { invert } from 'lodash';
import { action, computed, intercept, makeObservable, observable } from 'mobx';
import core from 'osu-core-singleton';
import { updateQueryString } from 'utils/url';

export const charToKey: Record<string, FilterKey> = {
  c: 'general',
  e: 'extra',
  g: 'genre',
  l: 'language',
  m: 'mode',
  nsfw: 'nsfw',
  played: 'played',
  q: 'query',
  r: 'rank',
  s: 'status',
  sort: 'sort',
};

export const keyToChar = invert(charToKey);

export const keyNames = ['extra', 'general', 'genre', 'language', 'mode', 'nsfw', 'played', 'query', 'rank', 'sort', 'status'] as const;

export function filtersFromUrl(url: string) {
  const params = new URL(url).searchParams;

  const filters: Partial<BeatmapsetSearchFilters> = {};

  for (const [char, key] of Object.entries(charToKey)) {
    const value = params.get(char);

    if (value == null || value.length === 0) continue;

    filters[key] = String(value); // TODO: handle boolean value
  }

  return filters;
}

export type BeatmapsetSearchParams = {
  [key in FilterKey]: filterValueType
};

export type FilterKey = (typeof keyNames)[number];
type filterValueType = string | null;


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

  constructor(url: string) {
    const filters = filtersFromUrl(url);
    for (const key of keyNames) {
      this[key] = filters[key] ?? null;
    }

    makeObservable(this);

    intercept(this, 'query', (change) => {
      change.newValue = osu.presence((change.newValue as filterValueType)?.trim());

      return change;
    });
  }

  @computed
  get displaySort() {
    // FIXME: should not return null.
    return this.selectedValue('sort');
  }

  @computed
  get queryParams() {
    const charParams: Record<string, filterValueType> = {};

    // undefineds should be treated as not specified
    for (const [key, value] of Object.entries(this.values)) {
      if (value === null || this.getDefault(key) !== value) {
        charParams[keyToChar[key]] = value;
      }
    }

    return charParams;
  }

  @computed
  get searchSort() {
    const [field, order] = (this.displaySort ?? '').split('_');
    return { field, order };
  }

  getDefault(key: FilterKey) {
    switch (key) {
      case 'nsfw':
        return String(core.userPreferences.get('beatmapset_show_nsfw'));
      case 'played':
        return 'any';
      case 'status':
        return 'leaderboard';
      case 'sort':
        if (this.query?.trim().length ?? 0 > 0) {
          return 'relevance_desc';
        } else if (['pending', 'wip', 'graveyard', 'mine'].includes(this.status ?? '')) {
          return 'updated_desc';
        } else {
          return 'ranked_desc';
        }
      default:
        return null;
    }
  }

  href(key: FilterKey, value: string | null) {
    const params = { [keyToChar[key]]: value };
    return updateQueryString(null, params);
  }

  selectedValue(key: FilterKey) {
    const value = this[key];
    if (value == null) {
      const defaultValue = this.getDefault(key);
      return typeof defaultValue === 'number' ? String(defaultValue) : osu.presence(defaultValue);
    }

    return typeof value === 'number' ? String(value) : osu.presence(value);
  }

  toKeyString() {
    const normalized = this.normalizedValues();
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
      const value = newFilters[key];
      if (value !== undefined) {
        this[key] = value;
      }
    }
  }

  private normalizedValues() {
    const ret: Partial<BeatmapsetSearchParams> = {};

    for (const key of keyNames) {
      ret[key] = this[key] ?? this.getDefault(key);
    }

    return ret as BeatmapsetSearchParams;
  }

  /**
   * Returns a cached copy of the values in the filter.
   */
  @computed
  private get values(): BeatmapsetSearchParams {
    return Object.assign({}, this);
  }
}
