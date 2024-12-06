// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DiscussionPage from './discussion-page';

type DiscussionMode = Exclude<DiscussionPage, 'events'>;
export const discussionModes: readonly DiscussionMode[] = ['reviews', 'generalAll', 'general', 'timeline'] as const;

export default DiscussionMode;
