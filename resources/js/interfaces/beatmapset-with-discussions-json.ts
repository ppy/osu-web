// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetDiscussionJsonForShow } from './beatmapset-discussion-json';
import BeatmapsetExtendedJson from './beatmapset-extended-json';

type DiscussionsRequiredAttributes = 'beatmaps' | 'current_user_attributes' | 'events' | 'nominations' | 'related_users';
type BeatmapsetWithDiscussionsJson = BeatmapsetExtendedJson & Required<Pick<BeatmapsetExtendedJson, DiscussionsRequiredAttributes>> & Omit<BeatmapsetExtendedJson, 'discussions'> & { discussions: BeatmapsetDiscussionJsonForShow[] };

export default BeatmapsetWithDiscussionsJson;
