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

import { BeatmapSearchFilters } from 'beatmap-search-filters';
import SearchResults from 'beatmaps/search-results';
import { action, observable } from 'mobx';

interface SearchResponse {
  beatmapsets: JSON[];
  cursor: JSON;
  recommended_difficulty: number;
  total: number;
}

export default class BeatmapSearchStore {
  static CACHE_DURATION_MS = 60000;

  readonly beatmapsets = new Map<string, any[]>();
  readonly cursors = new Map<string, any>();
  recommendedDifficulty = 0; // last known recommended difficulty.
  readonly requests = new Map<string, Promise<SearchResults>>();
  readonly totals = new Map<string, number>();
  readonly fetchedAt = new Map<string, Date>();

  getBeatmapsets(filters: BeatmapSearchFilters) {
    const key = filters.toKeyString();

    return this.getObservableBeatmapsetsByKey(key);
  }

  @action
  get(filters: BeatmapSearchFilters, from = 0): Promise<SearchResults> {
    if (from < 0) {
      throw Error('from must be > 0');
    }

    const key = filters.toKeyString();
    const beatmapsets = this.getObservableBeatmapsetsByKey(key);
    const sufficient = (from > 0 && from < beatmapsets.length) || (from === 0 && !this.isExpired(key));

    if (sufficient) {
      return Promise.resolve({
        beatmapsets,
        hasMore: this.hasMore(key),
        recommendedDifficulty: this.recommendedDifficulty,
        total: this.totals.get(key) || 0,
      });
    }

    // skip making multiple requests for the same key.
    const maybeRequest = this.requests.get(key);
    if (maybeRequest != null) { return maybeRequest; }

    const request = this.fetch(filters, from).then((data: SearchResponse) => {
      if (from === 0) {
        this.reset(key);
      }

      if (data.beatmapsets != null) {
        this.append(key, data);
      }

      this.recommendedDifficulty = data.recommended_difficulty;

      this.requests.delete(key);

      return {
        beatmapsets: this.getObservableBeatmapsetsByKey(key),
        hasMore: this.hasMore(key),
        recommendedDifficulty: this.recommendedDifficulty,
        total: this.totals.get(key) || 0,
      };
    });

    this.fetchedAt.set(key, new Date());
    this.requests.set(key, request);

    return request;
  }

  @action
  initialize(filters: BeatmapSearchFilters, data: SearchResponse) {
    const key = filters.toKeyString();

    if (this.cursors.has(key)) {
      return;
    }

    this.cursors.set(key, data.cursor);
    this.totals.set(key, data.total);
    this.fetchedAt.set(key, new Date());
    this.recommendedDifficulty = data.recommended_difficulty;

    const beatmapsets = this.getObservableBeatmapsetsByKey(key);
    for (const beatmapset of data.beatmapsets) {
      beatmapsets.push(beatmapset);
    }
  }

  private append(key: string, data: SearchResponse) {
    const beatmapsets = this.getObservableBeatmapsetsByKey(key);
    for (const beatmapset of data.beatmapsets) {
      beatmapsets.push(beatmapset);
    }

    this.cursors.set(key, data.cursor);
    this.totals.set(key, data.total);
  }

  private getObservableBeatmapsetsByKey(key: string) {
    let beatmapsets = this.beatmapsets.get(key);
    if (beatmapsets == null) {
      beatmapsets = observable([]);
      this.beatmapsets.set(key, beatmapsets);
    }

    return beatmapsets;
  }

  private fetch(filters: BeatmapSearchFilters, from: number) {
    const params = filters.queryParams;
    const key = filters.toKeyString();

    const cursor = this.cursors.get(key);
    if (from > 0 && this.cursors.has(key)) {
      if (cursor == null) {
        return Promise.resolve({});
      }

      params.cursor = cursor;
    }

    const url = laroute.route('beatmapsets.search');
    return $.ajax(url, {
      data: params,
      dataType: 'json',
      method: 'get',
    });
  }

  private hasMore(key: string) {
    // should return false only if it's known to have received a null cursor in.
    return !(this.cursors.has(key) && this.cursors.get(key) == null);
  }

  private isExpired(key: string) {
    const previous = this.fetchedAt.get(key);
    if (previous == null) { return true; }

    return new Date().getTime() - previous.getTime() > BeatmapSearchStore.CACHE_DURATION_MS;
  }

  private reset(key: string) {
    this.beatmapsets.set(key, observable([]));
    this.cursors.delete(key);
    this.totals.delete(key);
  }
}
