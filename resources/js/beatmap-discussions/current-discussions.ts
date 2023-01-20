// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from 'interfaces/game-mode';
import { BeatmapsetDiscussionJson } from 'legacy-modules';
import DiscussionsMode from './discussions-mode';

export type Filter = 'deleted' | 'hype' | 'mapperNotes' | 'mine' | 'pending' | 'praises' | 'resolved' | 'total';

// TODO: move to store/context
export default interface CurrentDiscussions {
  byFilter: Record<Filter, Record<DiscussionsMode, Partial<Record<number, BeatmapsetDiscussionJson>>>>;
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
