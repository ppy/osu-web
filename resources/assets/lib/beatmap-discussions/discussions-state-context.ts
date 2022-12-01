// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { createContext } from 'react';

interface Props {
  discussionCollapsed: Map<number, boolean>;
  discussionDefaultCollapsed: boolean;
  highlightedDiscussionId: number | null;
}

export function newDefault(): Props {
  return {
    discussionCollapsed: new Map<number, boolean>(),
    discussionDefaultCollapsed: false,
    highlightedDiscussionId: null,
  };
}

// TODO: combine with DiscussionsContext, BeatmapsetContext, etc into a store with properties.
const DiscussionsStateContext = createContext(newDefault());

export default DiscussionsStateContext;
