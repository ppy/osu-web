// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ShowMoreLink from 'components/show-more-link';
import { throttle } from 'lodash';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';

const autoPagerTriggerDistance = 3000;

@observer
export class Paginator extends React.Component<Record<string, never>> {
  private readonly lineRef = React.createRef<HTMLDivElement>();
  private readonly throttledAutoPagerOnScroll = throttle(() => this.autoPagerOnScroll(), 500);

  private get controller() {
    return core.beatmapsetSearchController;
  }

  componentDidMount() {
    setTimeout(this.throttledAutoPagerOnScroll, 0);
    $(window).on('scroll', this.throttledAutoPagerOnScroll);
  }

  componentWillUnmount() {
    $(window).off('scroll', this.throttledAutoPagerOnScroll);
    this.throttledAutoPagerOnScroll.cancel();
  }

  render() {
    return (
      <>
        <div ref={this.lineRef} />
        <ShowMoreLink
          callback={this.showMore}
          hasMore={this.controller.hasMore}
          loading={this.controller.isPaging}
          modifiers='beatmapsets'
        />
      </>
    );
  }

  private autoPagerOnScroll() {
    if (this.controller.error != null || !this.controller.hasMore || this.controller.isPaging || this.lineRef.current == null) {
      return;
    }

    const currentTarget = this.lineRef.current.getBoundingClientRect().top;
    const target = document.documentElement.clientHeight + autoPagerTriggerDistance;

    if (currentTarget > target) return;

    this.showMore();
  }

  private readonly showMore = () => {
    this.controller.loadMore();
  };
}
