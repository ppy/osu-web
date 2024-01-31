// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

// In display order on discussion page tabs
export const discussionPages = ['reviews', 'generalAll', 'general', 'timeline', 'events'] as const;
type DiscussionPage = (typeof discussionPages)[number];

const discussionPageSet = new Set<unknown>(discussionPages);

export function isDiscussionPage(value: unknown): value is DiscussionPage {
  return discussionPageSet.has(value);
}

export default DiscussionPage;
