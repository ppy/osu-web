// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { SearchResponse } from 'beatmaps/beatmapset-search';
import SearchResults from 'beatmaps/search-results';
import { action, computed, makeObservable, observable } from 'mobx';

export default class ResultSet implements SearchResults {
  static CACHE_DURATION_MS = 60000;

  @observable beatmapsetIds = new Set<number>();
  cursor?: unknown; // null -> end; undefined -> not set yet.
  fetchedAt?: Date;
  @observable hasMore = false;
  @observable total = 0;

  @computed
  get hasMoreForPager() {
    return this.hasMore && this.beatmapsetIds.size < this.total;
  }

  @computed
  get isExpired() {
    if (this.fetchedAt == null) {
      return true;
    }

    return new Date().getTime() - this.fetchedAt.getTime() > ResultSet.CACHE_DURATION_MS;
  }

  constructor() {
    makeObservable(this);
  }

  @action
  append(data: SearchResponse) {
    for (const beatmapset of data.beatmapsets) {
      this.beatmapsetIds.add(beatmapset.id);
    }

    this.cursor = data.cursor;
    this.fetchedAt = new Date();
    this.hasMore = data.cursor !== null;
    this.total = data.total; // TODO: total shouldn't be updated for snapshot?
  }

  @action
  reset() {
    this.beatmapsetIds.clear();
    this.fetchedAt = undefined;
    this.cursor = undefined;
    this.hasMore = false;
    this.total = 0;
  }
}
