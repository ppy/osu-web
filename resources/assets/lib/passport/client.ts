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

import { action, observable } from 'mobx';
import { TokenJSON } from 'passport/token-json';

export class Client {
  id: number;
  name: string | null;
  passwordClient: boolean;
  redirect: string;
  @observable revoked = false;
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

  @action
  revoke() {
    $.ajax({
      method: 'DELETE',
      url: laroute.route('oauth.authorized-clients.destroy', { authorized_client: this.id }),
    }).then(() => {
      this.revoked = true;
    });
  }
}
