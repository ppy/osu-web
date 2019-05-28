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
import AvailableFilters from 'beatmaps/available-filters';
import { debounce, isEqual } from 'lodash';
import { Lambda, observe } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { SearchContent } from 'react/beatmaps/search-content';
import { uiState } from './ui-state-store';

interface Props {
  availableFilters: AvailableFilters;
}

@observer
export class Main extends React.Component<Props> {
  readonly backToTop = React.createRef<BackToTop>();
  readonly backToTopAnchor = React.createRef<HTMLElement>();
  readonly debouncedSearch = debounce(uiState.search.bind(uiState), 500);
  readonly debouncedUpdateUrl = debounce(this.updateUrl, 500);
  readonly observerDisposers: Lambda[] = [];

  updateUrl() {
    const url = encodeURI(laroute.route('beatmapsets.index', BeatmapsetFilter.queryParamsFromFilters(uiState.filters)));
    Turbolinks.controller.advanceHistory(url);
  }

  constructor(props: Props) {
    super(props);

    uiState.restoreTurbolinks();

    this.observerDisposers.push(
      observe(uiState, 'searchStatus', (change) => {
        if (change.newValue.error != null) {
          osu.ajaxError(change.newValue.error);
        }
      }),
    );

    uiState.search();

    this.observerDisposers.push(
      observe(uiState, 'filters', (change) => {
        if (isEqual(change.oldValue, change.newValue)) {
          return;
        }

        // if only query has changed, debounce url update;
        // else update immediately
        // TODO: this works but the timing seems illogical?
        if (change.oldValue!.query !== change.newValue.query) {
          this.debouncedUpdateUrl();
        } else {
          this.updateUrl();
        }

        uiState.prepareToSearch();
        this.debouncedSearch();
      }),
    );

    this.observerDisposers.push(
      observe(uiState, 'searchStatus', (change) => {
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
      }),
    );
  }

  componentDidMount() {
    uiState.startListeningOnWindow();
  }

  componentWillUnmount() {
    uiState.stopListeningOnWindow();

    let disposer = this.observerDisposers.shift();
    while (disposer) {
      disposer();
      disposer = this.observerDisposers.shift();
    }

    this.debouncedSearch.cancel();
  }

  expand = (e: React.SyntheticEvent) => {
    e.preventDefault();
    uiState.isExpanded = true;
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
}
