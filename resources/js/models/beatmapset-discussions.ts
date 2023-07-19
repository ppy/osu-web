// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import BeatmapsetDiscussionJson from 'interfaces/beatmapset-discussion-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import UserJson from 'interfaces/user-json';

export default interface BeatmapsetDiscussions {
  beatmaps: Map<number, BeatmapExtendedJson>;
  beatmapsets: Map<number, BeatmapsetExtendedJson>;
  discussions: Map<number | null | undefined, BeatmapsetDiscussionJson>;
  users: Map<number | null | undefined, UserJson>;
}
