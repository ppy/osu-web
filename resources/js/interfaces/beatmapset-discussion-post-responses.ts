// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';

export interface BeatmapsetDiscussionPostStoreResponseJson {
  beatmap_discussion_id: number;
  beatmap_discussion_post_ids: number[];
  beatmapset: BeatmapsetWithDiscussionsJson;
}
