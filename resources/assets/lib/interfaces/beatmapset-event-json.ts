// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetJson from './beatmapset-json';
import GameMode from './game-mode';

export default interface BeatmapsetEventJson {
  beatmapset?: BeatmapsetJson;
  comment: any; // TODO: make always an object instead of object or string.
  created_at: string;
  discussion?: BeatmapsetDiscussionJson;
  id: number;
  nomination_modes?: GameMode[];
  starting_post?: string; // used when looking at user modding profile.
  type: string;
  user_id?: number;
}
