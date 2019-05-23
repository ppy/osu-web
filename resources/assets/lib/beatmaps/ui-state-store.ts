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

export class UIStateStore {
  @observable numberOfColumns = osu.isDesktop() ? 2 : 1;
  @observable hasMore = false;
  @observable isPaging = false;
  @observable loading = false;
  @observable recommendedDifficulty = 0;
  @observable filters: Filters = BeatmapsetFilter.fillDefaults(BeatmapsetFilter.filtersFromUrl(location.href));
  @observable isExpanded = intersection(Object.keys(BeatmapsetFilter.filtersFromUrl(location.href)), BeatmapsetFilter.expand).length > 0;

  // the list that gets displaying while new searches are loading.
  @observable currentBeatmapsets = store.getBeatmapsets(this.filters);

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
    if (from === 0) {
      this.loading = true;
    } else {
      this.isPaging = true;
    }

    // snapshot filter values since they may change during the request.
    const filters = Object.assign({}, this.filters);
    return store.get(filters, from)
    .then((data) => {
      this.isPaging = false;
      this.loading = false;
      this.hasMore = data.hasMore && data.beatmapsets.length < data.total;
      this.recommendedDifficulty = data.recommended_difficulty;

      if (isEqual(filters, this.filters)) {
        this.currentBeatmapsets = store.getBeatmapsets(filters);
      }
    })
    .catch((error) => {
      this.isPaging = false;
      this.loading = false;
      if (error.readyState !== 0) { throw error; }
    });
  }

  @action
  async loadMore() {
    const uiState = this;
    if (uiState.isPaging || uiState.loading || !uiState.hasMore) {
      return;
    }

    return this.search(this.currentBeatmapsets.length);
  }

  @action
  async search(from = 0) {
    if (this.isSupporterMissing || from < 0) {
      return Promise.resolve();
    }

    if (from > 0) {
      this.isPaging = true;
    } else {
      this.loading = true;
      // if (this.backToTop.current) this.backToTop.current.reset();
    }

    try {
      await this.performSearch(from);
      // if (from === 0 && this.backToTopAnchor.current) {
      //   const cutoff = this.backToTopAnchor.current.getBoundingClientRect().top;
      //   if (cutoff < 0) {
      //     window.scrollTo(window.pageXOffset, window.pageYOffset + cutoff);
      //   }
      // }
    } catch (error) {
      console.log(error);
      // TODO: catch shouldn't be here?
      osu.ajaxError(error);
    }
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

export const instance = new UIStateStore();
