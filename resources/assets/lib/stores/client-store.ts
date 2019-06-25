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
import { action, observable } from 'mobx';
import { TokenJSON } from 'passport/token-json';
import Store from 'stores/store';

class Client {
  id: number;
  name: string | null;
  passwordClient: boolean;
  redirect: string;
  @observable scopes: Set<string>;
  userId: number;

  constructor(token: TokenJSON) {
    this.id = token.client.id;
    this.name = token.client.name;
    this.passwordClient = token.client.password_client;
    this.redirect = token.client.redirect;
    this.scopes = new Set();
    this.userId = token.client.user_id;
  }
}

// tslint:disable-next-line: max-classes-per-file
export default class ClientStore extends Store {
  @observable clients = new Map<number, Client>();

  @action
  async fetchAll() {
    const response: TokenJSON[] = await $.get('/oauth/tokens');
    for (const token of response) {
      this.updateWithToken(token);
    }
  }

  handleDispatchAction(dispatchedAction: DispatcherAction) {
    if (dispatchedAction instanceof UserLoginAction
      || dispatchedAction instanceof UserLogoutAction) {
      this.flushStore();
    }
  }

  async revoke(clientId: number) {
    await $.ajax({
      method: 'DELETE',
      url: '/home/account/revoke-client/' + clientId,
    });

    this.fetchAll();
  }

  @action
  private flushStore() {
    this.clients.clear();
  }

  @action
  private updateWithToken(token: TokenJSON) {
    let client = this.clients.get(token.client_id);
    if (client == null) {
      client = new Client(token);
    }

    for (const scope of token.scopes) {
      client.scopes.add(scope);
    }

    this.clients.set(token.client_id, client);

    return client;
  }
}
