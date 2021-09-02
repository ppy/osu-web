// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DispatcherAction from 'actions/dispatcher-action';
import { UserLoginAction } from 'actions/user-login-actions';
import { ClientJson } from 'interfaces/client-json';
import { action, makeObservable, observable } from 'mobx';
import { Client } from 'models/oauth/client';

export default class ClientStore {
  @observable clients = new Map<number, Client>();

  constructor() {
    makeObservable(this);
  }

  handleDispatchAction(dispatchedAction: DispatcherAction) {
    if (dispatchedAction instanceof UserLoginAction) {
      this.flushStore();
    }
  }

  initialize(data: ClientJson[]) {
    for (const item of data) {
      const client = new Client(item);
      this.clients.set(client.id, client);
    }
  }

  @action
  private flushStore() {
    this.clients.clear();
  }
}
