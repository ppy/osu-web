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
import { BeatmapsetJSON } from 'beatmapsets/beatmapset-json';
import { action, observable } from 'mobx';
import { BeatmapsetStore } from 'stores/beatmapset-store';
import core from 'osu-core-singleton';

interface SearchResponse {
  beatmapsets: BeatmapsetJSON[];
  cursor: JSON;
  recommended_difficulty: number;
  total: number;
}

export default class BeatmapSearchStore {
  static CACHE_DURATION_MS = 60000;

  readonly beatmapsets = new Map<string, any[]>();
  readonly cursors = new Map<string, any>();
  readonly fetchedAt = new Map<string, Date>();
  recommendedDifficulty = 0; // last known recommended difficulty.
  readonly totals = new Map<string, number>();

  private readonly beatmapsetStore = new BeatmapsetStore();
  private xhr?: JQueryXHR;

  cancel() {
    if (this.xhr) {
      this.xhr.abort();
    }
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
      } as SearchResults);
    }

    return this.fetch(filters, from).then((data: SearchResponse) => {
      this.updateBeatmapsetStore(data);

      if (from === 0) {
        this.reset(key);
      }

      if (data.beatmapsets != null) {
        this.append(key, data);
      }

      this.recommendedDifficulty = data.recommended_difficulty;
      this.fetchedAt.set(key, new Date());

      return {
        beatmapsets: this.getObservableBeatmapsetsByKey(key),
        hasMore: this.hasMore(key),
        recommendedDifficulty: this.recommendedDifficulty,
        total: this.totals.get(key) || 0,
      };
    });
  }

  getBeatmapsets(filters: BeatmapSearchFilters) {
    const key = filters.toKeyString();

    return this.getObservableBeatmapsetsByKey(key);
  }

  @action
  initialize(filters: BeatmapSearchFilters, data: SearchResponse) {
    // FIXME: shouldn't init if already inited.
    this.updateBeatmapsetStore(data);

    const key = filters.toKeyString();

    if (this.cursors.has(key)) {
      return;
    }

    this.cursors.set(key, data.cursor);
    this.totals.set(key, data.total);
    this.fetchedAt.set(key, new Date());
    this.recommendedDifficulty = data.recommended_difficulty;

    this.appendBeatmapsets(key, data.beatmapsets);
  }

  private append(key: string, data: SearchResponse) {
    this.appendBeatmapsets(key, data.beatmapsets);
    this.cursors.set(key, data.cursor);
    this.totals.set(key, data.total);
  }

  private appendBeatmapsets(key: string, data: JSON[]) {
    const beatmapsets = this.getObservableBeatmapsetsByKey(key);
    // tslint:disable-next-line:prefer-const browsers that support ES6 but not const in for...of
    for (let beatmapset of data) {
      beatmapsets.push(beatmapset);
    }
  }

  private fetch(filters: BeatmapSearchFilters, from: number) {
    this.cancel();

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
    this.xhr = $.ajax(url, {
      data: params,
      dataType: 'json',
      method: 'get',
    });

    return this.xhr;
  }

  private getObservableBeatmapsetsByKey(key: string) {
    let beatmapsets = this.beatmapsets.get(key);
    if (beatmapsets == null) {
      beatmapsets = observable([]);
      this.beatmapsets.set(key, beatmapsets);
    }

    return beatmapsets;
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

  private updateBeatmapsetStore(response: SearchResponse) {
    console.log(response);
    for (const json of response.beatmapsets) {
      this.beatmapsetStore.update(json);
    }

    console.log(this.beatmapsetStore.beatmapsets.toJSON());
  }
}
