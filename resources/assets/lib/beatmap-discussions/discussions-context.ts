// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';

export const DiscussionsContext = React.createContext({} as Partial<Record<number, BeatmapsetDiscussionJson>>);
