/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import DispatcherAction from 'actions/dispatcher-action';
import { UserLoginAction, UserLogoutAction } from 'actions/user-login-actions';
import ResultSet from 'beatmaps/result-set';
import SearchResults from 'beatmaps/search-results';
import { BeatmapsetSearchFilters } from 'beatmapset-search-filters';
import { BeatmapsetJSON } from 'beatmapsets/beatmapset-json';
import DispatchListener from 'dispatch-listener';
import Dispatcher from 'dispatcher';
import { route } from 'laroute';
import { action, observable, runInAction } from 'mobx';
import { BeatmapsetStore } from 'stores/beatmapset-store';

export interface SearchResponse {
  beatmapsets: BeatmapsetJSON[];
  cursor: JSON;
  error?: string;
  recommended_difficulty: number;
  total: number;
}

export class BeatmapsetSearch implements DispatchListener {
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
  get(filters: BeatmapsetSearchFilters, from = 0): PromiseLike<SearchResults> {
    if (from < 0) {
      throw Error('from must be > 0');
    }

    const key = filters.toKeyString();
    const resultSet = this.getOrCreate(key);
    const sufficient = (from > 0 && from < resultSet.beatmapsetIds.length) || (from === 0 && !resultSet.isExpired);
    if (sufficient) {
      return Promise.resolve(resultSet);
    }

    return this.fetch(filters, from).then((data: SearchResponse) => {
      runInAction(() => {
        if (from === 0) {
          resultSet.reset();
        }

        this.updateBeatmapsetStore(data);
        resultSet.append(data);
        this.recommendedDifficulties.set(filters.mode, data.recommended_difficulty);
      });

      return resultSet;
    });
  }

  getResultSet(filters: BeatmapsetSearchFilters) {
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
  initialize(filters: BeatmapsetSearchFilters, data: SearchResponse) {
    this.updateBeatmapsetStore(data);

    const key = filters.toKeyString();
    const resultSet = this.getOrCreate(key);
    // skip if already tracking.
    if (resultSet.fetchedAt != null) {
      return;
    }

    resultSet.append(data);
    this.recommendedDifficulties.set(filters.mode, data.recommended_difficulty);
  }

  @action
  private clear() {
    this.resultSets.clear();
    this.recommendedDifficulties.clear();
  }

  private fetch(filters: BeatmapsetSearchFilters, from: number): PromiseLike<{}> {
    this.cancel();

    const params = filters.queryParams;
    const key = filters.toKeyString();
    const cursor = this.getOrCreate(key).cursor;

    // undefined cursor should just do a cursorless query.
    if (from > 0) {
      if (cursor != null) {
        params.cursor = cursor;
      } else if (cursor === null) {
        return Promise.resolve({});
      }
    }

    const url = route('beatmapsets.search');
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

  private updateBeatmapsetStore(response: SearchResponse) {
    for (const json of response.beatmapsets) {
      this.beatmapsetStore.update(json);
    }
  }
}
