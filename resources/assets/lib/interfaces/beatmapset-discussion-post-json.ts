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
  updated_at: string;
  user_id: number;
}

type BeatmapsetDiscussionMessagePostJson = BeatmapsetDiscussionPostDefaultAttributes & {
  message: string;
  system: false;
};

export type BeatmapsetDiscussionSystemPostJson = BeatmapsetDiscussionPostDefaultAttributes & {
  message: {
    type: string;
    value: boolean;
  };
  system: true;
};

type BeatmapsetDiscussionPostJson = (BeatmapsetDiscussionMessagePostJson | BeatmapsetDiscussionSystemPostJson) & Partial<BeatmapsetDiscussionPostAvailableIncludes>;
export default BeatmapsetDiscussionPostJson;
