// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapExtendedJson from './beatmap-extended-json';
import { BeatmapsetDiscussionJsonForBundle } from './beatmapset-discussion-json';
import BeatmapsetExtendedJson from './beatmapset-extended-json';
import UserJson from './user-json';

export default interface BeatmapsetDiscussionsBundleJson {
  beatmaps: BeatmapExtendedJson[];
  beatmapsets: BeatmapsetExtendedJson[];
  discussions: BeatmapsetDiscussionJsonForBundle[];
  included_discussions: BeatmapsetDiscussionJsonForBundle[];
  users: UserJson[];
}
