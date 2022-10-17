// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { createContext, RefObject } from 'react';

export interface Props {
  name?: string;
  offsetTop: number; // store the visible viewport offset somewhere (to account for sticky/fixed headers, etc)
  onWillUpdateScroll?: (key: string) => ReturnValue;
  ref?: RefObject<HTMLElement>;
}

export interface ReturnValue {
  float: boolean;
  focus: boolean;
  ref?: RefObject<HTMLElement>;
}

const LazyLoadContext = createContext<Props>({ offsetTop: 0 });

export default LazyLoadContext;
