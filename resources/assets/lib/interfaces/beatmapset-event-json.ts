// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetJson } from 'beatmapsets/beatmapset-json';

export default interface BeatmapsetEventJson {
  beatmapset?: BeatmapsetJson;
  comment: any; // TODO: make always an object instead of object or string.
  created_at: string;
  discussion?: BeatmapDiscussion;
  id: number;
  starting_post?: string; // used when looking at user modding profile.
  type: string;
  user_id?: number;
}
