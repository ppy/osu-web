// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DispatcherAction from 'actions/dispatcher-action';
import { UserLoginAction, UserLogoutAction } from 'actions/user-login-actions';
import { BeatmapsetJson } from 'beatmapsets/beatmapset-json';
import { action, observable } from 'mobx';

export class BeatmapsetStore {
  // store json for now to make it easier to work with existing coffeescript.
  @observable beatmapsets = observable.map<number, BeatmapsetJson>();

  get(id: number) {
    return this.beatmapsets.get(id);
  }

  handleDispatchAction(dispatcherAction: DispatcherAction) {
    if (dispatcherAction instanceof UserLoginAction
      || dispatcherAction instanceof UserLogoutAction) {
      this.flushStore();
    }
  }

  @action
  update(beatmapset: BeatmapsetJson) {
    // just override the value for now, we can do something fancier in the future.
    this.beatmapsets.set(beatmapset.id, beatmapset);
  }

  @action
  private flushStore() {
    this.beatmapsets.clear();
  }
}
