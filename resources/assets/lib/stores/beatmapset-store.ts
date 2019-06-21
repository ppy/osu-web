/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import DispatcherAction from 'actions/dispatcher-action';
import { UserLoginAction, UserLogoutAction } from 'actions/user-login-actions';
import { BeatmapsetJSON } from 'beatmapsets/beatmapset-json';
import { action, observable } from 'mobx';
import Store from 'stores/store';

export class BeatmapsetStore extends Store {
  // store json for now to make it easier to work with existing coffeescript.
  @observable beatmapsets = observable.map<number, BeatmapsetJSON>();

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
  update(beatmapset: BeatmapsetJSON) {
    // just override the value for now, we can do something fancier in the future.
    this.beatmapsets.set(beatmapset.id, beatmapset);
  }

  @action
  private flushStore() {
    this.beatmapsets.clear();
  }
}
