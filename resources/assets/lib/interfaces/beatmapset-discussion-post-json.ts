// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetDiscussionJson from './beatmapset-discussion-json';

interface BeatmapsetDiscussionPostAvailableIncludes {
  beatmap_discussion: BeatmapsetDiscussionJson;
}

interface BeatmapsetDiscussionPostDefaultAttributes {
  beatmapset_discussion_id: number;
  created_at: string;
  deleted_at?: string;
  deleted_by_id?: number;
  id: number;
  last_editor_id?: number;
  message: string;
  system: boolean;
  updated_at: string;
  user_id: number;
}

type BeatmapsetDiscussionPostJson = BeatmapsetDiscussionPostDefaultAttributes & Partial<BeatmapsetDiscussionPostAvailableIncludes>;
export default BeatmapsetDiscussionPostJson;
