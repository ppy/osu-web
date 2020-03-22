// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        <HeaderV4 theme='beatmapsets' />
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
