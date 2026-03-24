// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Component, createContext, Key } from 'react';

export interface State {
  activeKey?: any;
}

interface ContainerContextValue<T = (Key | null | undefined)> {
  activeKeyDidChange: (key: T) => void;
}

// TODO: need a better way of doing this without this.setState
export function activeKeyDidChange(this: Component, key: any) {
  this.setState({ activeKey: key });
}

export const ContainerContext = createContext<ContainerContextValue>({
  activeKeyDidChange: (_key: any) => { /* do nothing */},
});

export const KeyContext = createContext<any>(null);
