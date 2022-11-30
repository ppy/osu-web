// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from 'interfaces/game-mode';
import { BeatmapsetDiscussionJson } from 'legacy-modules';

export type Filter = 'deleted' | 'hype' | 'mapperNotes' | 'mine' | 'pending' | 'praises' | 'resolved' | 'total';

// TODO: move to store/context
export default interface CurrentDiscussions {
  byFilter: Record<Filter, DiscussionByFilter>;
  countsByBeatmap: Record<number, number>;
  countsByPlaymode: Record<GameMode, number>;
  general: BeatmapsetDiscussionJson[];
  generalAll: BeatmapsetDiscussionJson[];
  reviews: BeatmapsetDiscussionJson[];
  timeline: BeatmapsetDiscussionJson[];
  timelineAllUsers: BeatmapsetDiscussionJson[];
  totalHype: number;
  unresolvedIssues: number;
}

interface DiscussionByFilter {
  general: Record<number, BeatmapsetDiscussionJson>;
  generalAll: Record<number, BeatmapsetDiscussionJson>;
  reviews: Record<number, BeatmapsetDiscussionJson>;
  timeline: Record<number, BeatmapsetDiscussionJson>;
}
