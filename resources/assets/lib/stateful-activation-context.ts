// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { createContext } from 'react';

export interface State {
  activeKey?: any;
}

export function activeKeyDidChange(key: any) {
  this.setState({ activeKey: key });
}

export const ContainerContext = createContext({
  activeKeyDidChange: (key: any) => { /* do nothing */},
});

export const KeyContext = createContext<any>(null);
