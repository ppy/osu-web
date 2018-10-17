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

// import * as React from "react";

import {observable, autorun, action} from 'mobx';
import RootDataStore from './root-data-store';
import User, { UserJSON } from '../models/user';
import DispatchListener from '../dispatch-listener';
import DispatcherAction from '../actions/dispatcher-action';
import Dispatcher from '../dispatcher';

export default class UserStore implements DispatchListener {
  parent: RootDataStore;

  @observable users = observable.map<number, User>();

  constructor(root: RootDataStore, dispatcher: Dispatcher) {
    this.parent = root;
    dispatcher.register(this);
  }

  handleDispatchAction(action: DispatcherAction) {
  }

  @action
  getOrCreate(user_id: number, props?: UserJSON): User {
    let user: User;

    if (!user_id) {
      return;
    }

    if (this.users.has(user_id) && this.users.get(user_id).loaded) {
      user = this.users.get(user_id);
    } else {
      if (props) {
        user = User.fromJSON(props);
      } else {
        user = new User(user_id);
      }
      this.users.delete(user_id);
      this.users.set(user_id, user);
    }

    if (!user.loaded) {
      user.load();
    }

    return user;
  }
}
