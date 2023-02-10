// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetDiscussionJson from 'interfaces/beatmapset-discussion-json';
import GameMode from 'interfaces/game-mode';
import DiscussionMode from './discussion-mode';

export const filters = ['deleted', 'hype', 'mapperNotes', 'mine', 'pending', 'praises', 'resolved', 'total'] as const;
export type Filter = (typeof filters)[number];

// TODO: move to store/context
export default interface CurrentDiscussions {
  byFilter: Record<Filter, Record<DiscussionMode, Partial<Record<number, BeatmapsetDiscussionJson>>>>;
  countsByBeatmap: Partial<Record<number, number>>;
  countsByPlaymode: Partial<Record<GameMode, number>>;
  general: BeatmapsetDiscussionJson[];
  generalAll: BeatmapsetDiscussionJson[];
  reviews: BeatmapsetDiscussionJson[];
  timeline: BeatmapsetDiscussionJson[];
  timelineAllUsers: BeatmapsetDiscussionJson[];
  totalHype: number;
  unresolvedIssues: number;
}
