// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

// This is a port of https://github.com/developerdizzle/react-virtual-list updated for React 18
// using typescript and mobx with other unnecessary parts removed.

import { throttle } from 'lodash';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';

export interface Props<T> {
  children: (props: RenderProps<T>) => React.ReactNode;
  itemBuffer: number;
  itemHeight: number;
  items: T[];
}

export interface RenderProps<T> {
  items: T[];
}

const emptyItemBounds = { firstItemIndex: 0, lastItemIndex: 0 };

function topFromWindow(element: Window | HTMLElement | Element | null): number {
  if (element == null) return 0;

  const offsetTop = 'offsetTop' in element ? element.offsetTop : 0;
  const offsetParent = 'offsetParent' in element ? element.offsetParent : null;

  return offsetTop + topFromWindow(offsetParent);
}


@observer
export default class VirtualList<T> extends React.Component<Props<T>> {
  static readonly defaultProps = {
    itemBuffer: 0,
  };

  private readonly ref = React.createRef<HTMLDivElement>();
  private readonly scrollContainer = window; // we only care about window for now.
  @observable private scrollTop = 0;
  private readonly throttledSetScroll = throttle(() => this.setScroll(), 10);

  @computed
  private get visibleItemBounds() {
    const length = this.props.items.length;
    const viewHeight = this.scrollContainer.innerHeight;

    if (length === 0 || viewHeight === 0) return emptyItemBounds;

    const { itemBuffer, itemHeight } = this.props;
    const scrollBottom = this.scrollTop + viewHeight;

    const listTop = topFromWindow(this.ref.current) - topFromWindow(this.scrollContainer); // top of the list inside the scroll container
    const listHeight = itemHeight * length;

    // visible portion of the list
    const listViewTop = Math.max(0, this.scrollTop - listTop);
    const listViewBottom = Math.max(0, Math.min(listHeight, scrollBottom - listTop));

    // visible item indexes
    const firstItemIndex = Math.max(0, Math.floor(listViewTop / itemHeight) - itemBuffer);
    const lastItemIndex = Math.min(length, Math.ceil(listViewBottom / itemHeight) + itemBuffer);

    return {
      firstItemIndex,
      lastItemIndex,
    };
  }

  constructor(props: Props<T>) {
    super(props);

    makeObservable(this);
  }

  componentDidMount() {
    this.scrollContainer.addEventListener('scroll', this.throttledSetScroll);
  }

  componentWillUnmount() {
    this.scrollContainer.removeEventListener('scroll', this.throttledSetScroll);
  }

  render() {
    const visibleItemBounds = this.visibleItemBounds;
    const items = visibleItemBounds.lastItemIndex > 0 ? this.props.items.slice(visibleItemBounds.firstItemIndex, visibleItemBounds.lastItemIndex) : [];

    const style: React.CSSProperties = {
      boxSizing: 'border-box',
      height: this.props.items.length * this.props.itemHeight,
      paddingTop: visibleItemBounds.firstItemIndex * this.props.itemHeight,
    };

    return (
      <div ref={this.ref} style={style}>
        {this.props.children({ items })}
      </div>
    );
  }

  @action
  private setScroll = () => {
    this.scrollTop = this.scrollContainer.scrollY;
  };
}
