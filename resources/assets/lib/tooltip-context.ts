// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { createContext } from 'react';

export type ContextValue = HTMLElement | undefined;

export const TooltipContext = createContext(undefined as ContextValue);
