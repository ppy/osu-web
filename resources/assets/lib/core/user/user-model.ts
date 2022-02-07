// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { computed, makeObservable } from 'mobx';
import OsuCore from 'osu-core';

export default class UserModel {
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
}
