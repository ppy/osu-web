// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserRelationJson from 'interfaces/user-relation-json';
import { pull, remove } from 'lodash';
import { action, computed, makeObservable } from 'mobx';
import OsuCore from 'osu-core';
import { fail } from 'utils/fail';

export default class UserModel {
  @computed
  get blocks() {
    if (this.core.currentUser == null) {
      return new Set<number>();
    }

    return new Set(this.core.currentUser.blocks.map((b) => b.target_id));
  }

  @computed
  get followUserMapping() {
    if (this.core.currentUser == null) {
      return new Set();
    }

    return new Set(this.core.currentUser.follow_user_mapping);
  }

  @computed
  get friends() {
    if (this.core.currentUser == null) {
      return new Map<number, undefined>();
    }

    return new Map(this.core.currentUser.friends.map((f) => [f.target_id, f]));
  }

  constructor(private readonly core: OsuCore) {
    makeObservable(this);
  }

  isFriendWith(id: number) {
    return this.friends.get(id) != null;
  }

  @action
  updateFollowUserMapping(following: boolean, userId: number) {
    const currentUser = this.core.currentUser;
    if (currentUser == null) return;

    if (following) {
      currentUser.follow_user_mapping.push(userId);
    } else {
      pull(currentUser.follow_user_mapping, userId);
    }
  }

  @action
  updateUserRelation(userRelation: UserRelationJson | undefined, relationType: 'blocks' | 'friends', userId: number) {
    const currentUser = this.core.currentUser ?? fail('trying to update user relation of guest user');
    const relations = currentUser[relationType];

    if (userRelation == null) {
      remove(relations, (relation) => relation.target_id === userId);
    } else {
      relations.push(userRelation);
    }

    const otherRelations = currentUser[relationType === 'blocks' ? 'friends' : 'blocks'];
    remove(otherRelations, (relation) => relation.target_id === userId);
  }
}
