// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { createContext } from 'react';

export interface Props {
  done: (key: string, snapshot: Snapshot) => void;
  getSnapshot: (key: string) => Snapshot | undefined;
  scrolling: boolean;
}


export interface Snapshot {
  bounds: DOMRect;
  scrollY: number;
}

const LazyLoadContext = createContext<Props | null>(null);

export default LazyLoadContext;
