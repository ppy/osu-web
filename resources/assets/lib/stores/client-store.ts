// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DispatcherAction from 'actions/dispatcher-action';
import { UserLoginAction, UserLogoutAction } from 'actions/user-login-actions';
import { ClientJson } from 'interfaces/client-json';
import { action, observable } from 'mobx';
import { Client } from 'models/oauth/client';

export default class ClientStore {
  @observable clients = new Map<number, Client>();

  handleDispatchAction(dispatchedAction: DispatcherAction) {
    if (dispatchedAction instanceof UserLoginAction
      || dispatchedAction instanceof UserLogoutAction) {
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
