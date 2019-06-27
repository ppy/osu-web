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

import { SearchResponse } from 'beatmaps/beatmapset-search';
import SearchResults from 'beatmaps/search-results';
import { action, computed, observable } from 'mobx';

export default class ResultSet implements SearchResults {
  static CACHE_DURATION_MS = 60000;

  @observable beatmapsetIds: number[] = [];
  cursor?: JSON; // null -> end; undefined -> not set yet.
  fetchedAt?: Date;
  @observable hasMore = false;
  @observable total = 0;

  @computed
  get hasMoreForPager() {
    return this.hasMore && this.beatmapsetIds.length < this.total;
  }

  @computed
  get isExpired() {
    if (this.fetchedAt == null) { return true; }

    return new Date().getTime() - this.fetchedAt.getTime() > ResultSet.CACHE_DURATION_MS;
  }

  @action
  append(data: SearchResponse) {
    for (const beatmapset of data.beatmapsets) {
      this.beatmapsetIds.push(beatmapset.id);
    }

    this.cursor = data.cursor;
    this.fetchedAt = new Date();
    this.hasMore = data.cursor !== null;
    this.total = data.total; // TODO: total shouldn't be updated for snapshot?
  }

  @action
  reset() {
    this.beatmapsetIds = [];
    this.fetchedAt = undefined;
    this.cursor = undefined;
    this.hasMore = false;
    this.total = 0;
  }
}
