// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapExtendedJson from './beatmap-extended-json';
import BeatmapJson from './beatmap-json';
import BeatmapsetDiscussionJson from './beatmapset-discussion-json';
import BeatmapsetExtendedJson from './beatmapset-extended-json';
import UserJson from './user-json';

export default interface BeatmapsetDiscussionsStore<
  B extends BeatmapJson = BeatmapExtendedJson,
  D extends BeatmapsetDiscussionJson = BeatmapsetDiscussionJson,
> {
  beatmaps: Map<number, B>;
  beatmapsets: Map<number, BeatmapsetExtendedJson>;
  discussions: Map<number | null | undefined, D>;
  users: Map<number | null | undefined, UserJson>;
}
