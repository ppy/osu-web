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

import { BackToTop } from 'back-to-top';
import Filters from 'beatmap-search-filters';
import AvailableFilters from 'beatmaps/available-filters';
import { debounce, extend, isEqual } from 'lodash';
import { action, computed, Lambda, observe } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { SearchContent } from 'react/beatmaps/search-content';
import { instance as uiState } from './ui-state-store';

const store = core.dataStore.beatmapSearchStore;

interface Props {
  availableFilters: AvailableFilters;
  beatmaps: any;
  container: HTMLElement;
}

@observer
export class Main extends React.Component<Props> {
  readonly backToTop = React.createRef<BackToTop>();
  readonly backToTopAnchor = React.createRef<HTMLElement>();
  beatmapsetsCount = 0;
  readonly debouncedSearch = debounce(this.search, 500);

  filterObserverDispose: Lambda;

  constructor(props: Props) {
    super(props);

    // populate initial values
    store.initialize(uiState.filters, props.beatmaps);

    this.filterObserverDispose = observe(uiState, 'filters', (change) => {
      if (!isEqual(change.oldValue, change.newValue)) {
        const url = encodeURI(laroute.route('beatmapsets.index', BeatmapsetFilter.queryParamsFromFilters(uiState.filters)));
        Turbolinks.controller.pushHistoryWithLocationAndRestorationIdentifier(url, Turbolinks.uuid());
        uiState.loading = true;

        this.debouncedSearch();
      }
    });
  }

  componentDidMount() {
    $(document).on('beatmap:load_more.beatmaps', this.loadMore);
    $(document).on('beatmap:search:filtered.beatmaps', this.updateFilters);
    uiState.startListeningOnWindow();

    uiState.performSearch();
  }

  componentWillUnmount() {
    $(document).off('.beatmaps');
    $(window).off('.beatmaps');
    uiState.stopListeningOnWindow();

    if (this.filterObserverDispose) { this.filterObserverDispose(); }
    this.debouncedSearch.cancel();
  }

  expand = (e: React.SyntheticEvent) => {
    e.preventDefault();
    uiState.isExpanded = true;
  }

  @action
  loadMore = () => {
    if (uiState.isPaging || uiState.loading || !uiState.hasMore) {
      return;
    }

    this.search(this.beatmapsetsCount);
  }

  render() {
    this.beatmapsetsCount = store.getBeatmapsets(uiState.filters).length; // workaround to make SearchContent update

    return (
      <div className='osu-layout__section'>
        <SearchContent
          availableFilters={this.props.availableFilters}
          backToTopAnchor={this.backToTopAnchor}
          expand={this.expand}
        />
        <BackToTop anchor={this.backToTopAnchor} ref={this.backToTop} />
      </div>
    );
  }

  @action
  async search(from = 0) {
    if (this.isSupporterMissing || from < 0) {
      return Promise.resolve();
    }

    if (from > 0) {
      uiState.isPaging = true;
    } else {
      uiState.loading = true;
      if (this.backToTop.current) this.backToTop.current.reset();
    }

    try {
      await uiState.performSearch(from);
      if (from === 0 && this.backToTopAnchor.current) {
        const cutoff = this.backToTopAnchor.current.getBoundingClientRect().top;
        if (cutoff < 0) {
          window.scrollTo(window.pageXOffset, window.pageYOffset + cutoff);
        }
      }
    } catch (error) {
      osu.ajaxError(error);
    }
  }

  @computed
  get isSupporterMissing() {
    return !currentUser.is_supporter && BeatmapsetFilter.supporterRequired(uiState.filters).length > 0;
  }

  @action
  updateFilters = (event: any, newFilters: Partial<Filters>) => {
    const filters = extend({}, uiState.filters, newFilters);

    if (uiState.filters.query !== filters.query
      || uiState.filters.status !== filters.status) {
      filters.sort = null;
    }

    uiState.filters = BeatmapsetFilter.fillDefaults(filters);
  }
}
