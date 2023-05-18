// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetExtendedJson from './beatmapset-extended-json';

// TODO: make current_user_attributes required and set defaults for null user or something
type DiscussionsRequiredAttributes = 'beatmaps' | 'discussions' | 'events' | 'nominations' | 'related_users';
type BeatmapsetWithDiscussionsGuestJson = BeatmapsetExtendedJson & Required<Pick<BeatmapsetExtendedJson, DiscussionsRequiredAttributes>>;
export type BeatmapsetWithDiscussionsLoggedInJson = BeatmapsetExtendedJson & Required<Pick<BeatmapsetExtendedJson, DiscussionsRequiredAttributes | 'current_user_attributes'>>;
type BeatmapsetWithDiscussionsJson = BeatmapsetWithDiscussionsGuestJson | BeatmapsetWithDiscussionsLoggedInJson;

export default BeatmapsetWithDiscussionsJson;
