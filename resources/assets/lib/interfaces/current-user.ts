// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GroupJSON from 'interfaces/group-json';
import UserJSON from 'interfaces/user-json';
import UserRelationJson from 'interfaces/user-relation-json';

export default interface CurrentUser extends UserJSON {
  blocks: UserRelationJson[];
  follower_count?: number;
  friends: UserRelationJson[];
  groups: GroupJSON[];
  is_admin: boolean;
  unread_pm_count: number;
  user_preferences: Record<string, any>;
}
