// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ShowMoreLink from 'components/show-more-link';
import { throttle } from 'lodash';
import core from 'osu-core-singleton';
import * as React from 'react';

interface Props {
  error: any;
  loading: boolean;
  more: boolean;
}

const autoPagerTriggerDistance = 3000;

export class Paginator extends React.PureComponent<Props> {
  private lineRef = React.createRef<HTMLDivElement>();
  private throttledAutoPagerOnScroll = throttle(() => this.autoPagerOnScroll(), 500);

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
          hasMore={this.props.more}
          loading={this.props.loading}
          modifiers={['beatmapsets', 't-ddd']}
        />
      </>
    );
  }

  private autoPagerOnScroll() {
    if (this.props.error != null || !this.props.more || this.props.loading || this.lineRef.current == null) {
      return;
    }

    const currentTarget = this.lineRef.current.getBoundingClientRect().top;
    const target = document.documentElement.clientHeight + autoPagerTriggerDistance;

    if (currentTarget > target) return;

    this.showMore();
  }

  private readonly showMore = () => {
    core.beatmapsetSearchController.loadMore();
  };
}
