// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GroupJSON from 'interfaces/group-json';
import UserJSONExtended from 'interfaces/user-json-extended';
import UserRelationJson from 'interfaces/user-relation-json';
import GameMode from './game-mode';

export default interface CurrentUser extends UserJSONExtended {
  blocks: UserRelationJson[];
  follower_count?: number;
  friends: UserRelationJson[];
  groups: GroupJSON[];
  playmode: GameMode;
  unread_pm_count: number;
  user_preferences: Record<string, any>;
}
