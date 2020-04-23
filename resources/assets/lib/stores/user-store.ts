// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DispatcherAction from 'actions/dispatcher-action';
import { UserLogoutAction } from 'actions/user-login-actions';
import UserJSON from 'interfaces/user-json';
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
