// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export const discussionsModes = ['reviews', 'general', 'generalAll', 'timeline', 'events'] as const;
type DiscussionsMode = (typeof discussionsModes)[number];

export default DiscussionsMode;
