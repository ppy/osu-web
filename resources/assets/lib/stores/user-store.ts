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
import { UserLogoutAction } from 'actions/user-login-actions';
import { UserJSON } from 'chat/chat-api-responses';
import { action, observable } from 'mobx';
import User from 'models/user';
import Store from 'stores/store';

export default class UserStore extends Store {
  @observable users = observable.map<number, User>();

  @action
  flushStore() {
    this.users = observable.map<number, User>();
  }

  get(id: number) {
    return this.users.get(id);
  }

  @action
  getOrCreate(userId: number, props?: UserJSON): User {
    let user = this.users.get(userId);

    // TODO: update from props if newer?
    if (user && user.loaded) {
      return user;
    }

    if (props) {
      user = User.fromJSON(props);
    } else {
      user = new User(userId);
    }
    // this.users.delete(userId);
    this.users.set(userId, user);

    if (!user.loaded) {
      user.load();
    }

    return user;
  }

  handleDispatchAction(dispatchedAction: DispatcherAction) {
    if (dispatchedAction instanceof UserLogoutAction) {
      this.flushStore();
    }
  }

  @action
  updateWithJSON(data: UserJSON[] | undefined | null) {
    if (data == null) { return; }
    for (const json of data) {
      const user = User.fromJSON(json);
      this.users.set(user.id, user);
    }
  }
}
