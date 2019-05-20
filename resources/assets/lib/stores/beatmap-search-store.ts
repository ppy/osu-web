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

import Filters from 'beatmap-search-filters';
import SearchResponse from 'beatmaps/search-response';
import SearchResults from 'beatmaps/search-results';
import { action, observable } from 'mobx';

export default class BeatmapSearchStore {
  beatmapsets = new Map<string, any[]>();
  cursors = new Map<string, any>();
  requests = new Map<string, Promise<SearchResults>>();
  totals = new Map<string, number>();

  getBeatmapsets(filters: Filters): any[] {
    const key = this.stringFromFilters(filters);

    return this.getObservableBeatmapsetsByKey(key);
  }

  getObservableBeatmapsetsByKey(key: string) {
    let beatmapsets = this.beatmapsets.get(key);
    if (beatmapsets == null) {
      beatmapsets = observable([]);
      this.beatmapsets.set(key, beatmapsets);
    }

    return beatmapsets;
  }

  get(filters: Filters, from = 0): Promise<SearchResults> {
    const key = this.stringFromFilters(filters);
    const beatmapsets = this.getObservableBeatmapsetsByKey(key);
    const sufficient = from < beatmapsets.length;

    if (sufficient) {
      return Promise.resolve({
        beatmapsets,
        hasMore: this.hasMore(key),
        recommended_difficulty: 0,
        total: this.totals.get(key) || 0,
      });
    }

    // skip making multiple requests for the same key.
    let request = this.requests.get(key);
    if (request) { return request; }

    request = this.fetch(filters).then((data: SearchResponse) => {
      if (data.beatmapsets != null) {
        this.append(key, data);
      }

      this.requests.delete(key);

      return {
        beatmapsets: this.getObservableBeatmapsetsByKey,
        hasMore: this.hasMore(key),
        recommended_difficulty: data.recommended_difficulty,
        total: this.totals.get(key) || 0,
      };
    });
    this.requests.set(key, request);

    return request;
  }

  @action
  initialize(filters: Filters, data: SearchResponse) {
    const key = this.stringFromFilters(filters);

    // FIXME: do something else; this is currently here because I like speed
    if (this.cursors.has(key)) {
      console.log(`already initialized ${key}`);
      return;
    }

    console.log(`initialize ${key}`);
    this.cursors.set(key, data.cursor);
    this.totals.set(key, data.total);

    const beatmapsets = this.getObservableBeatmapsetsByKey(key);
    for (const beatmapset of data.beatmapsets) {
      beatmapsets.push(beatmapset);
    }
  }


  @action
  private append(url: string, data: SearchResponse) {
    const beatmapsets = this.getObservableBeatmapsetsByKey(url);
    for (const beatmapset of data.beatmapsets) {
      console.log('push');
      beatmapsets.push(beatmapset);
    }

    // this.beatmapsets.set(url, data.beatmapsets);
    this.cursors.set(url, data.cursor);
    this.totals.set(url, data.total);

    // const beatmapsets = concat(this.beatmapsets.get(url) || [], data.beatmapsets);
    // this.store(url, {
    //   ...data,
    //   beatmapsets,
    // });
  }

  private fetch(filters: Filters) {
    const params = BeatmapsetFilter.queryParamsFromFilters(filters) as any;
    const key = this.stringFromFilters(filters);

    const cursor = this.cursors.get(key);
    if (this.cursors.has(key)) {
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

  private hasMore(url: string) {
    // should return false only if it's known to have received a null cursor in .
    return !(this.cursors.has(url) && this.cursors.get(url) == null);
  }

  private store(url: string, data: SearchResponse) {
    this.beatmapsets.set(url, data.beatmapsets);
    this.cursors.set(url, data.cursor);
    this.totals.set(url, data.total);
  }

  private stringFromFilters(filters: Filters) {
    const normalized = BeatmapsetFilter.fillDefaults(filters) as any;
    const parts = [];
    for (const key of Object.keys(normalized)) {
      parts.push(`${key}=${normalized[key]}`);
    }

    return parts.join('&');
  }
}
