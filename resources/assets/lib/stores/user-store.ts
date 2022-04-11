// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DispatcherAction from 'actions/dispatcher-action';
import { dispatchListener } from 'app-dispatcher';
import MessageNewEvent from 'chat/message-new-event';
import DispatchListener from 'dispatch-listener';
import UserJson from 'interfaces/user-json';
import { action, makeObservable, observable } from 'mobx';
import User from 'models/user';

@dispatchListener
export default class UserStore implements DispatchListener {
  @observable users = observable.map<number, User>();

  constructor() {
    makeObservable(this);
  }

  @action
  flushStore() {
    this.users = observable.map<number, User>();
  }

  get(id: number) {
    return this.users.get(id);
  }

  handleDispatchAction(event: DispatcherAction) {
    if (event instanceof MessageNewEvent) {
      this.updateMany(event.json.users);
    }
  }

  @action
  update(json: UserJson): User {
    const userId = json.id;
    let user = this.users.get(userId);

    if (user == null) {
      user = new User(userId);
      this.users.set(userId, user);
    }

    user.updateWithJson(json);

    return user;
  }

  @action
  updateMany(data: UserJson[] | undefined | null) {
    if (data == null) return;
    for (const json of data) {
      this.update(json);
    }
  }
}
