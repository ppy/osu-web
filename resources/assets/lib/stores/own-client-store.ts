// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DispatcherAction from 'actions/dispatcher-action';
import { UserLoginAction, UserLogoutAction } from 'actions/user-login-actions';
import { OwnClientJson } from 'interfaces/own-client-json';
import { action, observable } from 'mobx';
import { OwnClient as Client } from 'models/oauth/own-client';

export default class OwnClientStore {
  @observable clients = new Map<number, Client>();

  handleDispatchAction(dispatchedAction: DispatcherAction) {
    if (dispatchedAction instanceof UserLoginAction
      || dispatchedAction instanceof UserLogoutAction) {
      this.flushStore();
    }
  }

  initialize(data: OwnClientJson[]) {
    for (const item of data) {
      this.updateWithJson(item);
    }
  }

  @action
  updateWithJson(json: OwnClientJson) {
    const client = new Client(json);
    this.clients.set(client.id, client);

    return client;
  }

  @action
  private flushStore() {
    this.clients.clear();
  }
}
