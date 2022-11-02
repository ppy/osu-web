// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetDiscussionJsonForBundle, BeatmapsetDiscussionJsonForShow } from 'interfaces/beatmapset-discussion-json';
import { createContext } from 'react';

// TODO: needs discussions need flattening / normalization
export const DiscussionsContext = createContext({} as Partial<Record<number, BeatmapsetDiscussionJsonForBundle | BeatmapsetDiscussionJsonForShow>>);
