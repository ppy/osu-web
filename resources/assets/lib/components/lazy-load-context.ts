// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { createContext, RefObject } from 'react';

export interface Props {
  getOptions: (key: string) => ReturnValue;
  name: string;
  offsetTop: number; // store the visible viewport offset somewhere (to account for sticky/fixed headers, etc)
  ref: RefObject<HTMLElement>;
}

interface ReturnValue {
  focus: boolean;
  unbottom: boolean;
}

const LazyLoadContext = createContext<Props | null>(null);

export default LazyLoadContext;
