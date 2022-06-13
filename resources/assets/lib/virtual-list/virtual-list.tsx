// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

// This is a port of https://github.com/developerdizzle/react-virtual-list updated for React 18
// using typescript and mobx with other unnecessary parts removed.

import { throttle } from 'lodash';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';

export interface Props<T> {
  itemBuffer: number;
  itemHeight: number;
  items: T[];
}

interface Options {
  initialState?: {
    firstItemIndex: number;
    lastItemIndex: number;
  };
}

export interface VirtualProps<T> {
  innerRef: React.RefObject<HTMLDivElement>;
  itemHeight?: number;

  virtual: {
    items: T[];
    style: Pick<React.CSSProperties, 'boxSizing' | 'height' | 'paddingTop'>;
  };
}

const VirtualList = <T,>(options?: Options) => (InnerComponent: React.ComponentType<VirtualProps<T>>) => observer(
  class vlist extends React.Component<Props<T>> {
    static readonly defaultProps = {
      itemBuffer: 0,
    };

    private _isMounted = false;

    private container: Window | HTMLElement;
    private domNode = React.createRef<HTMLDivElement>();

    private firstItemIndex = 0;
    private lastItemIndex = -1;

    private throttledRefreshState = throttle(() => this.refreshState(), 10);

    constructor(props: Props<T>) {
      super(props);

      // we only care about window for now.
      this.container = window;

      if (options?.initialState != null) {
        this.firstItemIndex = options.initialState.firstItemIndex;
        this.lastItemIndex = options.initialState.lastItemIndex;
      }

      this._isMounted = true;

      makeObservable(this, {
        firstItemIndex: observable,
        lastItemIndex: observable,
        refreshState: action,
        setStateIfNeeded: action,
      });
    }

    componentDidMount() {
      this.refreshState();

      this.container.addEventListener('scroll', this.throttledRefreshState);
      this.container.addEventListener('resize', this.throttledRefreshState);
    }

    componentWillUnmount() {
      this._isMounted = false;

      this.container.removeEventListener('scroll', this.throttledRefreshState);
      this.container.removeEventListener('resize', this.throttledRefreshState);
    }

    render() {
      const visibleItems = this.lastItemIndex > -1 ? this.props.items.slice(this.firstItemIndex, this.lastItemIndex + 1) : [];

      // style
      const height = this.props.items.length * this.props.itemHeight;
      const paddingTop = this.firstItemIndex * this.props.itemHeight;

      const virtual = {
        items: visibleItems,
        style: {
          boxSizing: 'border-box' as React.CSSProperties['boxSizing'],
          height,
          paddingTop,
        },
      };

      return <InnerComponent innerRef={this.domNode} {...this.props} virtual={virtual} />;
    }

    setStateIfNeeded(items: T[], itemHeight: number, itemBuffer: number) {
      // get first and lastItemIndex
      const state = getVisibleItemBounds(this.domNode.current, this.container, items, itemHeight, itemBuffer);

      if (state == null) return;

      if (state.firstItemIndex > state.lastItemIndex) return;

      if (state.firstItemIndex !== this.firstItemIndex) {
        this.firstItemIndex = state.firstItemIndex;
      }

      if (state.lastItemIndex !== this.lastItemIndex) {
        this.lastItemIndex = state.lastItemIndex;
      }
    }

    private refreshState = () => {
      if (!this._isMounted) return;

      const { itemHeight, items, itemBuffer } = this.props;

      this.setStateIfNeeded(items, itemHeight, itemBuffer);
    };
  },
);

function getVisibleItemBounds<T>(element: HTMLElement | null, container: Window | HTMLElement, items: T[], itemHeight: number, itemBuffer: number) {
  // early return if we can't calculate
  if (items.length === 0) return undefined;

  // what the user can see
  // how many pixels are visible
  const viewHeight: number = container.innerHeight ?? container.clientHeight;

  if (!viewHeight) return undefined;

  const viewTop = getElementTop(container); // top y-coordinate of viewport inside container
  const viewBottom = viewTop + viewHeight;

  const listTop = topFromWindow(element) - topFromWindow(container); // top y-coordinate of container inside window
  const listHeight = itemHeight * items.length;

  // visible list inside view
  const listViewTop =  Math.max(0, viewTop - listTop); // top y-coordinate of list that is visible inside view
  const listViewBottom = Math.max(0, Math.min(listHeight, viewBottom - listTop)); // bottom y-coordinate of list that is visible inside view

  // visible item indexes
  const firstItemIndex = Math.max(0, Math.floor(listViewTop / itemHeight) - itemBuffer);
  const lastItemIndex = Math.min(items.length, Math.ceil(listViewBottom / itemHeight) + itemBuffer) - 1;

  return {
    firstItemIndex,
    lastItemIndex,
  };
}

function getElementTop(element: Window | HTMLElement): number {
  if ('scrollY' in element && element.scrollY) return element.scrollY;

  if ('document' in element && element.document) {
    if (element.document.documentElement && element.document.documentElement.scrollTop) return element.document.documentElement.scrollTop;
    if (element.document.body && element.document.body.scrollTop) return element.document.body.scrollTop;

    return 0;
  }

  return element.scrollY ?? element.scrollTop ?? 0;
}

function topFromWindow(element: Window | HTMLElement | null): number {
  if (element == null) return 0;

  const offsetTop = 'offsetTop' in element ? element.offsetTop : 0;
  const offsetParent = 'offsetParent' in element ? element.offsetParent : null;

  return offsetTop + topFromWindow(offsetParent);
}

export default VirtualList;
