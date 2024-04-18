// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { pull } from 'lodash';
import { action, computed, makeObservable, toJS } from 'mobx';
import OsuCore from 'osu-core';

export default class UserModel {
  @computed
  get blocks() {
    if (this.core.currentUser == null) {
      return new Set<number>();
    }

    return new Set(this.core.currentUser.blocks.map((b) => b.target_id));
  }

  @computed
  get following() {
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

    // TODO: remove currentUser from window.
    if (window.currentUser.id != null) {
      window.currentUser.follow_user_mapping = toJS(currentUser.follow_user_mapping);
    }

    $.publish('user:followUserMapping:refresh');
  }
}
