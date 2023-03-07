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

type BeatmapsetDiscussionPostBase = BeatmapsetDiscussionPostDefaultAttributes & Partial<BeatmapsetDiscussionPostAvailableIncludes>;

export type BeatmapsetDiscussionMessagePostJson = BeatmapsetDiscussionPostBase & {
  message: string;
  system: false;
};

export type BeatmapsetDiscussionSystemPostJson = BeatmapsetDiscussionPostBase & {
  message: {
    type: 'resolved';
    value: boolean;
  };
  system: true;
};

type BeatmapsetDiscussionPostJson = BeatmapsetDiscussionMessagePostJson | BeatmapsetDiscussionSystemPostJson;
export default BeatmapsetDiscussionPostJson;
