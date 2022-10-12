// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { createContext } from 'react';

export interface Props {
  name?: string;
  offsetTop: number; // store the visible viewport offset somewhere (to account for sticky/fixed headers, etc)
  onWillRenderAfterLoad?: (key: string) => void;
  onWillUpdateScroll?: (key: string) => boolean;
}

const LazyLoadContext = createContext<Props>({ offsetTop: 0 });

export default LazyLoadContext;
