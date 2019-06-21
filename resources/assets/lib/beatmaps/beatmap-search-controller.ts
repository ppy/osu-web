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

import { BeatmapSearchFilters, BeatmapSearchParams } from 'beatmap-search-filters';
import { BeatmapSearch, SearchResponse } from 'beatmaps/beatmap-search';
import { debounce, intersection, map } from 'lodash';
import { action, computed, IObjectDidChange, IValueDidChange, Lambda, observable, observe, runInAction } from 'mobx';

export interface SearchStatus {
  error?: any;
  from: number;
  state: 'completed' // search not doing anything
    | 'input'        // receiving input but not searching
    | 'paging'       // getting more pages
    | 'searching'    // actually doing a search
    ;
}

export class BeatmapSearchController {
  // the list that gets displayed while new searches are loading.
  @observable currentBeatmapsets!: any[];
  @observable filters!: BeatmapSearchFilters;
  @observable hasMore = false; // TODO: figure out how to make this computed
  @observable isExpanded!: boolean;

  @observable searchStatus: SearchStatus = {
    error: null,
    from: 0,
    state: 'completed',
  };

  private readonly beatmapSearch = new BeatmapSearch();
  private readonly debouncedSearch = debounce(this.filterChangedSearch, 500);
  private filtersObserver!: Lambda;

  constructor() {
    this.restoreStateFromUrl();
    this.currentBeatmapsets = this.beatmapSearch.getBeatmapsets(this.filters);
  }

  @computed
  get error() {
    return this.searchStatus.error;
  }

  @computed
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
  get recommendedDifficulty() {
    return this.beatmapSearch.recommendedDifficulties.get(this.filters.mode);
  }

  @computed
  get supporterRequiredFilterText() {
    const filters = BeatmapsetFilter.supporterRequired(this.filters);
    const trans = map(filters, (name) => osu.trans(`beatmaps.listing.search.filters.${name}`));

    return osu.transArray(trans);
  }

  @action
  cancel() {
    this.debouncedSearch.cancel();
    this.beatmapSearch.cancel();
  }

  initialize(data: SearchResponse) {
    this.beatmapSearch.initialize(this.filters, data);
  }

  @action
  async loadMore() {
    if (this.isBusy || !this.hasMore) {
      return;
    }

    this.search(this.currentBeatmapsets.length);
  }

  @action
  restoreTurbolinks() {
    this.restoreStateFromUrl();
    this.search();
  }

  @action
  async search(from = 0) {
    if (this.isSupporterMissing || from < 0) {
      return;
    }

    this.searchStatus = {
      from,
      state: from === 0 ? 'searching' : 'paging',
    };

    try {
      const data = await this.beatmapSearch.get(this.filters, from);

      runInAction(() => {
        this.searchStatus = { state: 'completed', error: null, from };
        this.hasMore = data.hasMore && data.beatmapsets.length < data.total;

        this.currentBeatmapsets = this.beatmapSearch.getBeatmapsets(this.filters);
      });
    } catch (error) {
      runInAction(() => {
        if (error.readyState !== 0) {
          this.searchStatus = { state: 'completed', error, from };
        } else {
          this.searchStatus = { state: 'completed', error: null, from };
        }
      });
    }
  }

  @action
  updateFilters(newFilters: Partial<BeatmapSearchParams>) {
    this.filters.update(newFilters);
  }

  private filterChangedHandler = (change: IObjectDidChange) => {
    const valueChange = change as IValueDidChange<BeatmapSearchFilters>; // actual object is a union of types.
    if (valueChange.oldValue === valueChange.newValue) { return; }

    this.searchStatus.state = 'input';
    this.debouncedSearch();
    // not sure if observing change of private variable is a good idea
    // but computed value doesn't show up here
    if (change.name !== 'sanitizedQuery') {
      this.debouncedSearch.flush();
    }
  }

  private filterChangedSearch() {
    const url = encodeURI(laroute.route('beatmapsets.index', this.filters.queryParams));
    Turbolinks.controller.advanceHistory(url);

    this.search();
  }

  @action
  private restoreStateFromUrl() {
    const filtersFromUrl = BeatmapsetFilter.filtersFromUrl(location.href);

    if (this.filtersObserver != null) {
      this.filtersObserver();
    }
    this.filters = new BeatmapSearchFilters(location.href);
    this.filtersObserver = observe(this.filters, this.filterChangedHandler);

    this.isExpanded = intersection(Object.keys(filtersFromUrl), BeatmapsetFilter.expand).length > 0;
  }
}
