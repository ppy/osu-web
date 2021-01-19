// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetJson } from 'beatmapsets/beatmapset-json';

export function showVisual(beatmapset: BeatmapsetJson) {
  return !beatmapset.nsfw || (currentUser?.user_preferences?.beatmapset_show_nsfw ?? false);
}
