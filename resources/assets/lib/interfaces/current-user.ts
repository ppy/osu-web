// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GroupJson from 'interfaces/group-json';
import UserJsonExtended from 'interfaces/user-json-extended';
import UserRelationJson from 'interfaces/user-relation-json';
import GameMode from './game-mode';

export default interface CurrentUser extends UserJsonExtended {
  blocks: UserRelationJson[];
  follow_user_modding: number[];
  follower_count?: number;
  friends: UserRelationJson[];
  groups: GroupJson[];
  playmode: GameMode;
  unread_pm_count: number;
  user_preferences: Record<string, any>;
}
