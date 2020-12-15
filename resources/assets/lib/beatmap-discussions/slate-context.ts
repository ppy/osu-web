// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { ReactEditor } from 'slate-react';

// null! is a workaround to remove the optional/nullable type for the context.
// SlateContext should always be assigned a ReactEditor value before being used.
// TODO: figure out how to remove the props dependency in editor.tsx when for initializing?
export const SlateContext = React.createContext<ReactEditor>(null!);
