// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ComponentType, CSSProperties } from 'react';

declare module 'react-virtual-list' {
  // just the basic things we need.
  interface Props<T> {
    itemBuffer: number;
    itemHeight: number;
    items: T[];
  }

  export interface VirtualProps<T> {
    itemHeight?: number;
    virtual: {
      items: T[];
      style: Pick<CSSProperties, 'boxSizing' | 'height' | 'paddingTop'>;
    };
  }

  export default function VirtualList<T>(): (wrapped: ComponentType<VirtualProps<T>>) => ComponentType<Props<T>>;
}
