// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

// This is a port of https://github.com/developerdizzle/react-virtual-list updated for React 18
// using typescript and mobx with other unnecessary parts removed.

import { throttle } from 'lodash';
import { action, makeObservable, observable, reaction } from 'mobx';
import { disposeOnUnmount, observer } from 'mobx-react';
import * as React from 'react';

export interface Props<T> {
  children: (props: VirtualProps<T>) => React.ReactNode;
  initialState?: {
    firstItemIndex: number;
    lastItemIndex: number;
  };
  itemBuffer: number;
  itemHeight: number;
  items: T[];
}

export interface VirtualProps<T> {
  items: T[];
}

function getElementTop(element: Window | HTMLElement): number {
  // window
  if ('scrollY' in element) return element.scrollY;

  // not window
  return element.scrollTop;
}

function getVisibleItemBounds(element: HTMLElement | null, container: Window | HTMLElement, length: number, itemHeight: number, itemBuffer: number) {
  // early return if we can't calculate
  if (length === 0) return;

  // what the user can see
  // how many pixels are visible
  const viewHeight: number = 'innerHeight' in container ? container.innerHeight : container.clientHeight;

  if (viewHeight === 0) return;

  const scrollTop = getElementTop(container); // top of the scroll container
  const scrollBottom = scrollTop + viewHeight;

  const listTop = topFromWindow(element) - topFromWindow(container); // top of the list inside the scroll container
  const listHeight = itemHeight * length;

  // visible portion of the list
  const listViewTop = Math.max(0, scrollTop - listTop);
  const listViewBottom = Math.max(0, Math.min(listHeight, scrollBottom - listTop));

  // visible item indexes
  const firstItemIndex = Math.max(0, Math.floor(listViewTop / itemHeight) - itemBuffer);
  const lastItemIndex = Math.min(length, Math.ceil(listViewBottom / itemHeight) + itemBuffer);

  return {
    firstItemIndex,
    lastItemIndex,
  };
}

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

  @observable private firstItemIndex = 0;
  @observable private lastItemIndex = 0;
  private readonly ref = React.createRef<HTMLDivElement>();
  private readonly scrollContainer = window; // we only care about window for now.
  private readonly throttledRefreshState = throttle(() => this.refreshState(), 10);

  constructor(props: Props<T>) {
    super(props);

    if (this.props.initialState != null) {
      this.firstItemIndex = this.props.initialState.firstItemIndex;
      this.lastItemIndex = this.props.initialState.lastItemIndex;
    }

    disposeOnUnmount(
      this,
      // ensure new items are rendered when loaded.
      reaction(() => this.props.items, this.throttledRefreshState),
    );

    makeObservable(this);
  }

  componentDidMount() {
    this.throttledRefreshState();

    this.scrollContainer.addEventListener('scroll', this.throttledRefreshState);
    this.scrollContainer.addEventListener('resize', this.throttledRefreshState);
  }

  componentWillUnmount() {
    this.scrollContainer.removeEventListener('scroll', this.throttledRefreshState);
    this.scrollContainer.removeEventListener('resize', this.throttledRefreshState);
  }

  render() {
    const items = this.lastItemIndex > 0 ? this.props.items.slice(this.firstItemIndex, this.lastItemIndex) : [];

    const style = {
      boxSizing: 'border-box' as React.CSSProperties['boxSizing'],
      height: this.props.items.length * this.props.itemHeight,
      paddingTop: this.firstItemIndex * this.props.itemHeight,
    };

    return (
      <div ref={this.ref} style={style}>
        {this.props.children({ items })}
      </div>
    );
  }

  @action
  private refreshState = () => {
    const state = getVisibleItemBounds(this.ref.current, this.scrollContainer, this.props.items.length, this.props.itemHeight, this.props.itemBuffer);

    if (state == null) return;

    if (state.firstItemIndex >= state.lastItemIndex) return;

    if (state.firstItemIndex !== this.firstItemIndex) {
      this.firstItemIndex = state.firstItemIndex;
    }

    if (state.lastItemIndex !== this.lastItemIndex) {
      this.lastItemIndex = state.lastItemIndex;
    }
  };
}
