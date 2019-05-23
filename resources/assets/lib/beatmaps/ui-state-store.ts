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
import { intersection, isEqual, map } from 'lodash';
import { action, computed, observable } from 'mobx';
import core from 'osu-core-singleton';

const store = core.dataStore.beatmapSearchStore;

interface SearchStatus {
  error?: any;
  from: number;
  state: 'completed' // search not doing anything
    | 'input'        // receiving input but not searching
    | 'paging'       // getting more pages
    | 'searching'    // actually doing a search
    ;
}

class UIStateStore {
  @observable numberOfColumns = osu.isDesktop() ? 2 : 1;
  @observable hasMore = false;
  @observable recommendedDifficulty = 0;
  @observable filters: Filters = BeatmapsetFilter.fillDefaults(BeatmapsetFilter.filtersFromUrl(location.href));
  @observable isExpanded = intersection(Object.keys(BeatmapsetFilter.filtersFromUrl(location.href)), BeatmapsetFilter.expand).length > 0;
  @observable searchStatus: SearchStatus = {
    error: null,
    from: 0,
    state: 'completed',
  };

  // the list that gets displaying while new searches are loading.
  @observable currentBeatmapsets = store.getBeatmapsets(this.filters);

  get isBusy() {
    return this.searchStatus.state === 'searching' || this.searchStatus.state === 'input';
  }

  @computed
  get isPaging() {
    return this.searchStatus.state === 'paging';
  }

  @computed
  get isSupporterMissing() {
    return !currentUser.is_supporter && BeatmapsetFilter.supporterRequired(this.filters).length > 0;
  }

  @computed
  get supporterRequiredFilterText() {
    const filters = BeatmapsetFilter.supporterRequired(this.filters);
    const trans = map(filters, (name) => osu.trans(`beatmaps.listing.search.filters.${name}`));

    return osu.transArray(trans);
  }

  @action
  async performSearch(from = 0) {
    this.searchStatus = {
      from,
      state: from === 0 ? 'searching' : 'paging',
    };

    // snapshot filter values since they may change during the request.
    const filters = Object.assign({}, this.filters);
    return store.get(filters, from)
    .then((data) => {
      this.searchStatus = { state: 'completed', error: null, from };
      this.hasMore = data.hasMore && data.beatmapsets.length < data.total;
      this.recommendedDifficulty = data.recommended_difficulty;

      if (isEqual(filters, this.filters)) {
        this.currentBeatmapsets = store.getBeatmapsets(filters);
      }
    })
    .catch((error) => {
      this.searchStatus = { state: 'completed', error, from };
      if (error.readyState !== 0) {
        throw error;
      }
    });
  }

  @action
  prepareToSearch() {
    this.searchStatus.state = 'input';
  }

  @action
  async loadMore() {
    if (this.searchStatus.state !== 'completed' || !this.hasMore) {
      return;
    }

    return this.search(this.currentBeatmapsets.length);
  }

  @action
  async search(from = 0) {
    if (this.isSupporterMissing || from < 0) {
      return Promise.resolve();
    }

    return this.performSearch(from);
  }

  @action
  updateFilters(newFilters: Partial<Filters>) {
    const filters = Object.assign({}, this.filters, newFilters);

    if (this.filters.query !== filters.query
      || this.filters.status !== filters.status) {
      filters.sort = null;
    }

    this.filters = BeatmapsetFilter.fillDefaults(filters);
  }

  startListeningOnWindow() {
    $(window).on('resize.beatmaps-ui-state-store', () => {
      const count = osu.isDesktop() ? 2 : 1;
      if (this.numberOfColumns !== count) {
        this.numberOfColumns = count;
      }
    });
  }

  stopListeningOnWindow() {
    $(window).off('.beatmaps-ui-state-store');
  }
}

export const uiState = new UIStateStore();
