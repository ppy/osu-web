// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export type ReportableType =
  | 'beatmapset'
  | 'beatmapset_discussion_post'
  | 'comment'
  | 'forum_post'
  | 'message'
  | 'solo_score'
  | 'team'
  | 'user';

export default interface Reportable {
  id: string;
  type: ReportableType;
}
