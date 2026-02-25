// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { invert } from 'lodash';
import { action, computed, makeObservable, observable } from 'mobx';
import core from 'osu-core-singleton';
import { presence, present } from 'utils/string';
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
export type FilterKey = (typeof keyNames)[number];
type FilterValueType = string | null;

const changesResetSorts: FilterKey[] = ['query', 'status'];
const filtersRequireSupporter: FilterKey[] = ['played', 'rank'];

export function filtersFromUrl(url: string) {
  const params = new URL(url).searchParams;

  const filters: Partial<BeatmapsetSearchFilters> = {};

  for (const [char, key] of Object.entries(charToKey)) {
    const value = params.get(char);

    if (value == null || value.length === 0) continue;

    filters[key] = value;
  }

  return filters;
}

export class BeatmapsetSearchFilters {
  @observable extra: FilterValueType = null;
  @observable general: FilterValueType = null;
  @observable genre: FilterValueType = null;
  @observable language: FilterValueType = null;
  @observable mode: FilterValueType = null;
  @observable nsfw: FilterValueType = null;
  @observable played: FilterValueType = null;

  /**
   * Contains the raw unprocessed contents of the search panel input box.
   * Should not be used by external consumers unless required.
   */
  @observable query: FilterValueType = null;

  @observable rank: FilterValueType = null;
  @observable sort: FilterValueType = null;
  @observable status: FilterValueType = null;

  /**
   * Contains the cleaned up, trimmed search input query. Consumers should
   * use this instead of {@link query} if it isn't required for some reason.
   */
  @computed
  get queryClean() {
    return presence((this.query)?.trim()) ?? null;
  }

  @computed
  get displaySort() {
    // FIXME: should not return null.
    return this.selectedValue('sort');
  }

  @computed
  get queryParams() {
    const charParams: Record<string, FilterValueType> = {};

    for (const key of keyNames) {
      const value = this.getValue(key);

      charParams[keyToChar[key]] = value === this.getDefault(key) ? null : value;
    }

    return charParams;
  }

  @computed
  get searchSort() {
    const [field, order] = (this.displaySort ?? '').split('_');
    return { field, order };
  }

  @computed
  get supporterRequired() {
    return keyNames.filter((key) => this[key] != null && filtersRequireSupporter.includes(key));
  }

  constructor(url: string) {
    const filters = filtersFromUrl(url);
    for (const key of keyNames) {
      const value = filters[key] ?? null;
      this[key] = value === this.getDefault(key) ? null : value;
    }

    makeObservable(this);
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
        if (present(this.query)) {
          return 'relevance_desc';
        } else if (['pending', 'wip', 'graveyard', 'mine'].includes(this.status ?? '')) {
          return 'updated_desc';
        } else {
          return 'ranked_desc';
        }
    }

    return null;
  }

  href(key: FilterKey, value: string | null) {
    const actualValue = value === this.getDefault(key) ? null : value;
    return updateQueryString(null, { ...this.queryParams, [keyToChar[key]]: actualValue });
  }

  selectedValue(key: FilterKey) {
    return this.getValue(key) ?? this.getDefault(key);
  }

  toKeyString() {
    return keyNames.map((key) => `${key}=${this.selectedValue(key)}`).join('&');
  }

  @action
  update(key: FilterKey, value: FilterValueType) {
    const oldValue = this[key];
    if (value === oldValue) return;
    if (changesResetSorts.includes(key)) {
      this.sort = null;
    }

    this[key] = value === this.getDefault(key) ? null : value;
  }

  private getValue(key: FilterKey) {
    if (key === 'query') return this.queryClean;

    return this[key];
  }
}
