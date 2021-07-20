// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetSearch, SearchResponse } from 'beatmaps/beatmapset-search';
import ResultSet from 'beatmaps/result-set';
import { BeatmapsetSearchFilters, BeatmapsetSearchParams } from 'beatmapset-search-filters';
import { route } from 'laroute';
import { debounce, intersection, map } from 'lodash';
import { action, computed, IObjectDidChange, IValueDidChange, Lambda, observable, observe, runInAction } from 'mobx';

export interface SearchStatus {
  error?: any;
  from: number;
  restore?: boolean;
  state: 'completed' // search not doing anything
  | 'input'        // receiving input but not searching
  | 'paging'       // getting more pages
  | 'searching'    // actually doing a search
  ;
}

export class BeatmapsetSearchController {
  @observable advancedSearch = false;
  // the list that gets displayed while new searches are loading.
  @observable currentResultSet = new ResultSet();
  @observable filters!: BeatmapsetSearchFilters;
  @observable isExpanded!: boolean;

  @observable searchStatus: SearchStatus = {
    error: null,
    from: 0,
    state: 'completed',
  };

  // eslint-disable-next-line @typescript-eslint/unbound-method
  private readonly debouncedFilterChangedSearch = debounce(this.filterChangedSearch, 500);
  private filtersObserver!: Lambda;
  private initialErrorMessage?: string;

  constructor(private beatmapsetSearch: BeatmapsetSearch) {}

  @computed
  get currentBeatmapsetIds() {
    return [...this.currentResultSet.beatmapsetIds];
  }

  @computed
  get error() {
    return this.searchStatus.error;
  }

  @computed
  get hasMore() {
    return this.currentResultSet.hasMoreForPager;
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
    return this.beatmapsetSearch.recommendedDifficulties.get(this.filters.mode);
  }

  @computed
  get supporterRequiredFilterText() {
    const filters = BeatmapsetFilter.supporterRequired(this.filters);
    const trans = map(filters, (name) => osu.trans(`beatmaps.listing.search.filters.${name}`));

    return osu.transArray(trans);
  }

  @action
  cancel() {
    this.debouncedFilterChangedSearch.cancel();
    this.beatmapsetSearch.cancel();
  }

  initialize(data: SearchResponse) {
    this.restoreStateFromUrl();
    this.beatmapsetSearch.initialize(this.filters, data);
    this.initialErrorMessage = data.error;
  }

  @action
  loadMore() {
    if (this.isBusy || !this.hasMore) {
      return;
    }

    this.search(this.currentResultSet.beatmapsetIds.size);
  }

  @action
  restoreTurbolinks() {
    this.restoreStateFromUrl();
    this.search(0, true);
    if (this.initialErrorMessage != null) {
      osu.popup(this.initialErrorMessage, 'danger');
      delete this.initialErrorMessage;
    }
  }

  @action
  async search(from = 0, restore = false) {
    if (this.isSupporterMissing || from < 0) {
      this.searchStatus = { error: null, from, restore, state: 'completed' };
      return;
    }

    this.searchStatus = {
      from: 0,
      restore,
      state: from === 0 ? 'searching' : 'paging',
    };

    let error: any;
    try {
      await this.beatmapsetSearch.get(this.filters, from);
    } catch (searchError) {
      error = searchError.readyState !== 0 ? searchError : null;
    }

    runInAction(() => {
      this.searchStatus = { error, from, restore, state: 'completed' };
      this.currentResultSet = this.beatmapsetSearch.getResultSet(this.filters);
    });
  }

  @action
  updateFilters(newFilters: Partial<BeatmapsetSearchParams>) {
    this.filters.update(newFilters);
  }

  private filterChangedHandler = (change: IObjectDidChange) => {
    const valueChange = change as IValueDidChange<BeatmapsetSearchFilters>; // actual object is a union of types.
    if (valueChange.oldValue === valueChange.newValue) return;
    // FIXME: sort = null changes ignored because search triggered too early during filter update.
    if (change.name === 'sort' && valueChange.newValue == null) return;

    this.searchStatus.state = 'input';
    this.debouncedFilterChangedSearch();

    if (change.name !== 'query') {
      this.debouncedFilterChangedSearch.flush();
    }
  };

  private filterChangedSearch() {
    const url = route('beatmapsets.index', this.filters.queryParams);
    Turbolinks.controller.advanceHistory(url);

    this.search();
  }

  @action
  private restoreStateFromUrl() {
    const currentUrl = window.newUrl ?? location.href;
    const filtersFromUrl = BeatmapsetFilter.filtersFromUrl(currentUrl);

    if (this.filtersObserver != null) {
      this.filtersObserver();
    }
    this.filters = new BeatmapsetSearchFilters(currentUrl);
    this.filtersObserver = observe(this.filters, this.filterChangedHandler);

    this.isExpanded = intersection(Object.keys(filtersFromUrl), BeatmapsetFilter.expand).length > 0;
  }
}
