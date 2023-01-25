// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export const discussionPages = ['reviews', 'general', 'generalAll', 'timeline', 'events'] as const;
export type DiscussionPage = (typeof discussionPages)[number];

type DiscussionMode = Exclude<DiscussionPage, 'events'>;

export default DiscussionMode;
