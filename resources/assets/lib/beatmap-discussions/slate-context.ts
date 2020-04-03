// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { ReactEditor } from 'slate-react';

export const SlateContext = React.createContext<ReactEditor | null>(null);
