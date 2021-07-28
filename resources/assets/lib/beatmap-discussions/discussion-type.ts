// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

const discussionTypes = ['hype', 'mapper_note', 'praise', 'problem', 'review', 'suggestion'] as const;
export type DiscussionType = (typeof discussionTypes)[number];

export const discussionTypeIcons: Record<DiscussionType, string> = {
  hype: 'fas fa-bullhorn',
  mapper_note: 'far fa-sticky-note',
  praise: 'fas fa-heart',
  problem: 'fas fa-exclamation-circle',
  review: 'fas fa-tasks',
  suggestion: 'far fa-circle',
};
