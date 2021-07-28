// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

const discussionTypes = ['hype', 'mapperNote', 'praise', 'problem', 'suggestion'] as const;
export type DiscussionType = (typeof discussionTypes)[number];

export const discussionTypeIcons: Record<DiscussionType, string> = {
  hype: 'fas fa-fw fa-bullhorn',
  mapperNote: 'far fa-fw fa-sticky-note',
  praise: 'fas fa-fw fa-heart',
  problem: 'fas fa-fw fa-exclamation-circle',
  suggestion: 'far fa-fw fa-circle',
};
