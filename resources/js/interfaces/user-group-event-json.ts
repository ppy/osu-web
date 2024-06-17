// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Ruleset from './ruleset';

interface UserGroupEventBase {
  actor?: {
    id: number;
    username: string;
  } | null;
  created_at: string;
  group_id: number;
  group_name: string;
  hidden: boolean;
  id: number;
}

interface GroupAddOrRemoveEvent extends UserGroupEventBase {
  type: 'group_add' | 'group_remove';
  user_id: null;
  user_name: null;
}

interface GroupRenameEvent extends UserGroupEventBase {
  previous_group_name: string;
  type: 'group_rename';
  user_id: null;
  user_name: null;
}

interface UserAddEvent extends UserGroupEventBase {
  playmodes: Ruleset[] | null;
  type: 'user_add';
  user_id: number;
  user_name: string;
}

interface UserAddOrRemovePlaymodesEvent extends UserGroupEventBase {
  playmodes: Ruleset[];
  type: 'user_add_playmodes' | 'user_remove_playmodes';
  user_id: number;
  user_name: string;
}

interface UserRemoveOrSetDefaultEvent extends UserGroupEventBase {
  type: 'user_remove' | 'user_set_default';
  user_id: number;
  user_name: string;
}

type UserGroupEventJson =
  | GroupAddOrRemoveEvent
  | GroupRenameEvent
  | UserAddEvent
  | UserAddOrRemovePlaymodesEvent
  | UserRemoveOrSetDefaultEvent;

export default UserGroupEventJson;
