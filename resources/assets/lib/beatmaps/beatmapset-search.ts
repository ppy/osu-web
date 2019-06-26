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
import ResultSet from 'beatmaps/result-set';
import SearchResults from 'beatmaps/search-results';
import { BeatmapsetSearchFilters } from 'beatmapset-search-filters';
import { BeatmapsetJSON } from 'beatmapsets/beatmapset-json';
import DispatchListener from 'dispatch-listener';
import Dispatcher from 'dispatcher';
import { action, observable, runInAction } from 'mobx';
import { BeatmapsetStore } from 'stores/beatmapset-store';

export interface SearchResponse {
  beatmapsets: BeatmapsetJSON[];
  cursor: JSON;
  recommended_difficulty: number;
  total: number;
}

export class BeatmapsetSearch implements DispatchListener {
  static CACHE_DURATION_MS = 60000;

  @observable readonly recommendedDifficulties = new Map<string|null, number>();
  @observable readonly resultSets = new Map<string, ResultSet>();

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
  get(filters: BeatmapsetSearchFilters, from = 0): Promise<SearchResults> {
    if (from < 0) {
      throw Error('from must be > 0');
    }

    const key = filters.toKeyString();
    const resultSet = this.getOrCreate(key);
    const sufficient = (from > 0 && from < resultSet.beatmapsets.length) || (from === 0 && !this.isExpired(resultSet));
    if (sufficient) {
      return Promise.resolve(resultSet);
    }

    return this.fetch(filters, from).then((data: SearchResponse) => {
      runInAction(() => {
        if (from === 0) {
          this.reset(resultSet);
        }

        this.updateBeatmapsetStore(data);
        this.append(resultSet, data);
        this.recommendedDifficulties.set(filters.mode, data.recommended_difficulty);
      });

      return resultSet;
    });
  }

  getBeatmapsets(filters: BeatmapsetSearchFilters) {
    const key = filters.toKeyString();

    return this.getOrCreate(key).beatmapsets;
  }

  handleDispatchAction(dispatcherAction: DispatcherAction) {
    if (dispatcherAction instanceof UserLoginAction
      || dispatcherAction instanceof UserLogoutAction) {
      this.clear();
    }
  }

  @action
  initialize(filters: BeatmapsetSearchFilters, data: SearchResponse) {
    this.updateBeatmapsetStore(data);

    const key = filters.toKeyString();
    const resultSet = this.getOrCreate(key);
    // skip if already tracking.
    if (resultSet.fetchedAt != null) {
      return;
    }

    this.append(resultSet, data);
    this.recommendedDifficulties.set(filters.mode, data.recommended_difficulty);
  }

  private append(resultSet: ResultSet, data: SearchResponse) {
    const beatmapsets = resultSet.beatmapsets;
    for (const beatmapset of data.beatmapsets) {
      const item = this.beatmapsetStore.get(beatmapset.id);
      if (item) {
        beatmapsets.push(item);
      }
    }

    resultSet.cursors = data.cursor;
    resultSet.fetchedAt = new Date();
    resultSet.hasMore = data.cursor !== null;
    resultSet.total = data.total; // TODO: total shouldn't be updated for snapshot?
  }

  @action
  private clear() {
    this.resultSets.clear();
    this.recommendedDifficulties.clear();
  }

  private fetch(filters: BeatmapsetSearchFilters, from: number) {
    this.cancel();

    const params = filters.queryParams;
    const key = filters.toKeyString();
    const cursor = this.getOrCreate(key).cursors;

    // undefined cursor should just do a cursorless query.
    if (from > 0) {
      if (cursor != null) {
        params.cursor = cursor;
      } else if (cursor === null) {
      return Promise.resolve({});
    }
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
    let resultSet = this.resultSets.get(key);
    if (resultSet == null) {
      resultSet = new ResultSet();

      this.resultSets.set(key, resultSet);
    }

    return resultSet;
  }

  private isExpired(resultSet: ResultSet) {
    if (resultSet.fetchedAt == null) { return true; }

    return new Date().getTime() - resultSet.fetchedAt.getTime() > BeatmapsetSearch.CACHE_DURATION_MS;
  }

  /**
   * Resets the entry at the given key.
   * It does not delete and recreate the entry as that is confusing for callers.
   *
   * @param key toKeyString() value of filters.
   */
  private reset(resultSet: ResultSet) {
    resultSet.beatmapsets = [];
    resultSet.fetchedAt = undefined;
    resultSet.cursors = undefined;
    resultSet.hasMore = false;
    resultSet.total = 0;
  }

  private updateBeatmapsetStore(response: SearchResponse) {
    for (const json of response.beatmapsets) {
      this.beatmapsetStore.update(json);
    }
  }
}
