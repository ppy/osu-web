// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DispatcherAction from 'actions/dispatcher-action';
import { dispatchListener } from 'app-dispatcher';
import ChatMessageNewEvent from 'chat/chat-message-new-event';
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

  @action
  getOrCreate(userId: number, props?: UserJson): User {
    let user = this.users.get(userId);

    // TODO: update from props if newer?
    if (user && user.loaded) {
      return user;
    }

    if (props) {
      user = User.fromJson(props);
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

  handleDispatchAction(event: DispatcherAction) {
    if (event instanceof ChatMessageNewEvent) {
      this.updateWithJson(event.json.users);
    }
  }

  @action
  updateWithJson(data: UserJson[] | undefined | null) {
    if (data == null) return;
    for (const json of data) {
      const user = User.fromJson(json);
      this.users.set(user.id, user);
    }
  }
}
