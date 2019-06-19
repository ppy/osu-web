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
import { BeatmapSearchFilters } from 'beatmap-search-filters';
import AvailableFilters from 'beatmaps/available-filters';
import { debounce } from 'lodash';
import { IObjectDidChange, IValueDidChange, Lambda, observe } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { SearchContent } from 'react/beatmaps/search-content';
import { controller, SearchStatus } from './controller';

interface Props {
  availableFilters: AvailableFilters;
}

@observer
export class Main extends React.Component<Props> {
  readonly backToTop = React.createRef<BackToTop>();
  readonly backToTopAnchor = React.createRef<HTMLElement>();
  readonly debouncedSearch = debounce(this.search, 500);
  readonly observerDisposers: Lambda[] = [];

  constructor(props: Props) {
    super(props);

    this.observerDisposers.push(observe(controller, 'searchStatus', this.searchStatusErrorHandler));

    // includes an initial search to load the pre-initialized data properly.
    controller.restoreTurbolinks();

    this.observerDisposers.push(observe(controller.filters, this.filterChangedHandler));
    this.observerDisposers.push(observe(controller, 'searchStatus', this.scrollPositionHandler));
  }

  componentDidMount() {
    $(document).on('turbolinks:before-visit.beatmaps-main', () => {
      this.debouncedSearch.cancel();
    });
  }

  componentWillUnmount() {
    $(document).off('.beatmaps-main');
    this.debouncedSearch.cancel();
    controller.cancel();

    let disposer = this.observerDisposers.shift();
    while (disposer) {
      disposer();
      disposer = this.observerDisposers.shift();
    }
  }

  render() {
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

  search() {
    const url = encodeURI(laroute.route('beatmapsets.index', controller.filters.queryParams));
    Turbolinks.controller.advanceHistory(url);
    controller.search();
  }

  private expand = (e: React.SyntheticEvent) => {
    e.preventDefault();
    controller.isExpanded = true;
  }

  private filterChangedHandler = (change: IObjectDidChange) => {
    const valueChange = change as IValueDidChange<BeatmapSearchFilters>; // actual object is a union of types.
    if (valueChange.oldValue === valueChange.newValue) { return; } // in case something goes horribly wrong in dev.

    controller.prepareToSearch();
    this.debouncedSearch();
    // not sure if observing change of private variable is a good idea
    // but computed value doesn't show up here
    if (change.name !== 'sanitizedQuery') {
      this.debouncedSearch.flush();
    }
  }

  private scrollPositionHandler = (change: IValueDidChange<SearchStatus>) => {
    if (change.oldValue === change.newValue) { return; }

    if (change.newValue.state === 'completed' && change.newValue.from === 0) {
      if (this.backToTopAnchor.current) {
        const cutoff = this.backToTopAnchor.current.getBoundingClientRect().top;
        if (cutoff < 0) {
          window.scrollTo(window.pageXOffset, window.pageYOffset + cutoff);
        }
      }
    }

    if (change.newValue.state === 'searching' && this.backToTop.current) {
      this.backToTop.current.reset();
    }
  }

  private searchStatusErrorHandler = (change: IValueDidChange<SearchStatus>) => {
    if (change.newValue.error != null) {
      osu.ajaxError(change.newValue.error);
    }
  }
}
