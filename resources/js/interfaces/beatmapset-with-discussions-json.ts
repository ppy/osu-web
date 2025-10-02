// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapExtendedJson from './beatmap-extended-json';
import { BeatmapsetDiscussionJsonForShow } from './beatmapset-discussion-json';
import BeatmapsetExtendedJson from './beatmapset-extended-json';
import WithBeatmapOwners from './with-beatmap-owners';

type DiscussionsRequiredAttributes = 'current_user_attributes' | 'eligible_main_rulesets' | 'events' | 'nominations' | 'related_users' | 'version_count';
type BeatmapsetWithDiscussionsJson =
  Omit<BeatmapsetExtendedJson, keyof OverrideIncludes>
  & OverrideIncludes
  & Required<Pick<BeatmapsetExtendedJson, DiscussionsRequiredAttributes>>;

interface OverrideIncludes {
  beatmaps: WithBeatmapOwners<BeatmapExtendedJson>[];
  discussions: BeatmapsetDiscussionJsonForShow[];
}

export default BeatmapsetWithDiscussionsJson;
