// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import AvailableFilters from 'beatmaps/available-filters';
import { BackToTop } from 'components/back-to-top';
import HeaderV4 from 'components/header-v4';
import { isEqual } from 'lodash';
import { reaction } from 'mobx';
import { disposeOnUnmount, observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { SearchContent } from 'react/beatmaps/search-content';
import { nextVal } from 'utils/seq';
import { SearchStatus } from './beatmapset-search-controller';

const controller = core.beatmapsetSearchController;

interface Props {
  availableFilters: AvailableFilters;
}

@observer
export class Main extends React.Component<Props> {
  readonly backToTop = React.createRef<BackToTop>();
  readonly backToTopAnchor = React.createRef<HTMLElement>();

  private readonly eventId = `beatmapsets-index-${nextVal()}`;

  constructor(props: Props) {
    super(props);

    disposeOnUnmount(this, reaction(() => controller.searchStatus, this.searchStatusErrorHandler));
  }

  componentDidMount() {
    disposeOnUnmount(this, reaction(() => controller.searchStatus, this.scrollPositionHandler));
    $(document).on(`turbolinks:before-visit.${this.eventId}`, () => {
      controller.cancel();
    });
  }

  componentWillUnmount() {
    $(document).off(`.${this.eventId}`);
    controller.cancel();
  }

  render() {
    return (
      <>
        <HeaderV4 theme='beatmapsets' />
        <SearchContent
          availableFilters={this.props.availableFilters}
          backToTopAnchor={this.backToTopAnchor}
        />
        <BackToTop ref={this.backToTop} anchor={this.backToTopAnchor} />
      </>
    );
  }

  private scrollPositionHandler = (value: SearchStatus, oldValue: SearchStatus) => {
    if (value.restore) return;
    if (isEqual(oldValue, value)) return;

    if (value.state === 'completed' && value.from === 0) {
      if (this.backToTopAnchor.current) {
        const cutoff = this.backToTopAnchor.current.getBoundingClientRect().top;
        if (cutoff < 0) {
          window.scrollTo(window.pageXOffset, window.pageYOffset + cutoff);
        }
      }
    }

    if (value.state === 'searching' && this.backToTop.current) {
      this.backToTop.current.reset();
    }
  };

  private searchStatusErrorHandler = (value: SearchStatus) => {
    if (value.error != null) {
      osu.ajaxError(value.error);
    }
  };
}
