// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { createContext, Key } from 'react';

interface ContainerContextValue<T = (Key | null | undefined)> {
  activeKeyDidChange: (key: T) => void;
}

export const ContainerContext = createContext<ContainerContextValue>({
  activeKeyDidChange: (_key: any) => { /* do nothing */},
});

export const KeyContext = createContext<Key | null | undefined>(null);
