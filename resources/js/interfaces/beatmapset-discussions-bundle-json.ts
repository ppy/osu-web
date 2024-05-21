// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Direction, VoteSummary } from 'modding-profile/votes';
import BeatmapExtendedJson from './beatmap-extended-json';
import { BeatmapsetDiscussionJsonForBundle } from './beatmapset-discussion-json';
import { BeatmapsetDiscussionMessagePostJson } from './beatmapset-discussion-post-json';
import BeatmapsetEventJson from './beatmapset-event-json';
import BeatmapsetExtendedJson from './beatmapset-extended-json';
import KudosuHistoryJson from './kudosu-history-json';
import UserJson from './user-json';
import UserModdingProfileJson from './user-modding-profile-json';

export default interface BeatmapsetDiscussionsBundleJson {
  beatmaps: BeatmapExtendedJson[];
  beatmapsets: BeatmapsetExtendedJson[];
  discussions: BeatmapsetDiscussionJsonForBundle[];
  included_discussions: BeatmapsetDiscussionJsonForBundle[];
  users: UserJson[];
}

export interface BeatmapsetDiscussionsBundleJsonForModdingProfile {
  beatmaps: BeatmapExtendedJson[];
  beatmapsets: BeatmapsetExtendedJson[];
  discussions: BeatmapsetDiscussionJsonForBundle[];
  events: BeatmapsetEventJson[];
  extras: {
    recentlyReceivedKudosu: KudosuHistoryJson[];
  };
  perPage: {
    recentlyReceivedKudosu: number;
  };
  posts: BeatmapsetDiscussionMessagePostJson[];
  user: UserModdingProfileJson;
  users: UserJson[];
  votes: Record<Direction, VoteSummary[]>;
}
