/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
import DispatchListener from 'dispatch-listener';
import Dispatcher from 'dispatcher';
import {action, observable} from 'mobx';
import User, { UserJSON } from 'models/user';
import RootDataStore from './root-data-store';

export default class UserStore implements DispatchListener {
  root: RootDataStore;

  @observable users = observable.map<number, User>();

  constructor(root: RootDataStore, dispatcher: Dispatcher) {
    this.root = root;
    dispatcher.register(this);
  }

  handleDispatchAction(dispatchedAction: DispatcherAction) {
    // whee
  }

  @action
  getOrCreate(userId: number, props?: UserJSON): User {
    let user: User | undefined = this.users.get(userId);

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
}
