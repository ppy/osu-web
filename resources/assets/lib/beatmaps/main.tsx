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
import HeaderV4 from 'header-v4';
import { isEqual } from 'lodash';
import { IValueDidChange, Lambda, observe } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { SearchContent } from 'react/beatmaps/search-content';
import { SearchStatus } from './beatmapset-search-controller';

const controller = core.beatmapsetSearchController;

interface Props {
  availableFilters: AvailableFilters;
}

@observer
export class Main extends React.Component<Props> {
  readonly backToTop = React.createRef<BackToTop>();
  readonly backToTopAnchor = React.createRef<HTMLElement>();
  readonly observerDisposers: Lambda[] = [];

  constructor(props: Props) {
    super(props);

    this.observerDisposers.push(observe(controller, 'searchStatus', this.searchStatusErrorHandler));
  }

  componentDidMount() {
    this.observerDisposers.push(observe(controller, 'searchStatus', this.scrollPositionHandler));
    $(document).on('turbolinks:before-visit.beatmaps-main', () => {
      controller.cancel();
    });
  }

  componentWillUnmount() {
    $(document).off('.beatmaps-main');
    controller.cancel();

    let disposer = this.observerDisposers.shift();
    while (disposer) {
      disposer();
      disposer = this.observerDisposers.shift();
    }
  }

  render() {
    return (
      <>
        <HeaderV4
          theme='beatmapsets'
          section={osu.trans('layout.header.beatmapsets._')}
          subSection={osu.trans('layout.header.beatmapsets.index')}
        />
        <SearchContent
          availableFilters={this.props.availableFilters}
          backToTopAnchor={this.backToTopAnchor}
        />
        <BackToTop anchor={this.backToTopAnchor} ref={this.backToTop} />
      </>
    );
  }

  private scrollPositionHandler = (change: IValueDidChange<SearchStatus>) => {
    if (change.newValue.restore) { return; }
    if (isEqual(change.oldValue, change.newValue)) { return; }

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
