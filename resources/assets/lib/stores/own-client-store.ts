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
import { OwnClientJSON } from 'interfaces/own-client-json';
import { action, observable } from 'mobx';
import { OwnClient as Client } from 'models/oauth/own-client';
import Store from 'stores/store';

export default class OwnClientStore extends Store {
  @observable clients = new Map<number, Client>();

  handleDispatchAction(dispatchedAction: DispatcherAction) {
    if (dispatchedAction instanceof UserLoginAction
      || dispatchedAction instanceof UserLogoutAction) {
      this.flushStore();
    }
  }

  initialize(data: OwnClientJSON[]) {
    for (const item of data) {
      this.updateWithJson(item);
    }
  }

  @action
  updateWithJson(json: OwnClientJSON) {
    const client = new Client(json);
    this.clients.set(client.id, client);

    return client;
  }

  @action
  private flushStore() {
    this.clients.clear();
  }
}
