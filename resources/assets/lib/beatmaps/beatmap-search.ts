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

import DispatcherAction from 'actions/dispatcher-action';
import { UserLoginAction, UserLogoutAction } from 'actions/user-login-actions';
import { BeatmapSearchFilters } from 'beatmap-search-filters';
import SearchResults from 'beatmaps/search-results';
import { BeatmapsetJSON } from 'beatmapsets/beatmapset-json';
import DispatchListener from 'dispatch-listener';
import Dispatcher from 'dispatcher';
import { action, observable } from 'mobx';
import { BeatmapsetStore } from 'stores/beatmapset-store';

export interface SearchResponse {
  beatmapsets: BeatmapsetJSON[];
  cursor: JSON;
  recommended_difficulty: number;
  total: number;
}

export class BeatmapSearch implements DispatchListener {
  static CACHE_DURATION_MS = 60000;

  @observable
  readonly beatmapsets = new Map<string, BeatmapsetJSON[]>();
  readonly cursors = new Map<string, any>();
  readonly fetchedAt = new Map<string, Date>();
  @observable readonly recommendedDifficulties = new Map<string|null, number>();
  readonly totals = new Map<string, number>();

  private xhr?: JQueryXHR;

  constructor(private beatmapsetStore: BeatmapsetStore, private dispatcher: Dispatcher) {
    this.dispatcher.register(this);
  }

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
    const beatmapsets = this.getOrCreate(key);
    const sufficient = (from > 0 && from < beatmapsets.length) || (from === 0 && !this.isExpired(key));

    if (sufficient) {
      return Promise.resolve({
        beatmapsets,
        hasMore: this.hasMore(key),
        recommendedDifficulty: this.recommendedDifficulties.get(filters.mode) || 0,
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

      this.recommendedDifficulties.set(filters.mode, data.recommended_difficulty);
      this.fetchedAt.set(key, new Date());

      return {
        beatmapsets: this.getOrCreate(key),
        hasMore: this.hasMore(key),
        recommendedDifficulty: data.recommended_difficulty,
        total: this.totals.get(key) || 0,
      };
    });
  }

  getBeatmapsets(filters: BeatmapSearchFilters) {
    const key = filters.toKeyString();

    return this.getOrCreate(key);
  }

  handleDispatchAction(dispatcherAction: DispatcherAction) {
    if (dispatcherAction instanceof UserLoginAction
      || dispatcherAction instanceof UserLogoutAction) {
      this.clear();
    }
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
    this.recommendedDifficulties.set(filters.mode, data.recommended_difficulty);

    this.appendBeatmapsets(key, data.beatmapsets);
  }

  private append(key: string, data: SearchResponse) {
    this.appendBeatmapsets(key, data.beatmapsets);
    this.cursors.set(key, data.cursor);
    this.totals.set(key, data.total);
  }

  private appendBeatmapsets(key: string, data: BeatmapsetJSON[]) {
    const beatmapsets = this.getOrCreate(key);
    for (const beatmapset of data) {
      const item = this.beatmapsetStore.get(beatmapset.id);
      if (item) {
        beatmapsets.push(item);
      }
    }
  }

  @action
  private clear() {
    this.beatmapsets.clear();
    this.cursors.clear();
    this.fetchedAt.clear();
    this.recommendedDifficulties.clear();
    this.totals.clear();
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

  private getOrCreate(key: string) {
    let beatmapsets = this.beatmapsets.get(key);
    if (beatmapsets == null) {
      this.beatmapsets.set(key, []);
      beatmapsets = this.beatmapsets.get(key);
    }

    return beatmapsets!;
  }

  private hasMore(key: string) {
    // should return false only if it's known to have received a null cursor in.
    return !(this.cursors.has(key) && this.cursors.get(key) == null);
  }

  private isExpired(key: string) {
    const previous = this.fetchedAt.get(key);
    if (previous == null) { return true; }

    return new Date().getTime() - previous.getTime() > BeatmapSearch.CACHE_DURATION_MS;
  }

  private reset(key: string) {
    this.beatmapsets.set(key, observable([]));
    this.cursors.delete(key);
    this.totals.delete(key);
  }

  private updateBeatmapsetStore(response: SearchResponse) {
    for (const json of response.beatmapsets) {
      this.beatmapsetStore.update(json);
    }
  }
}
