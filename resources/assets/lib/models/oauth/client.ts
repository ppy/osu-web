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

import { ClientJSON } from 'interfaces/client-json';
import { route } from 'laroute';
import { action, observable } from 'mobx';

export class Client {
  id: number;
  @observable isRevoking = false;
  name: string | null;
  @observable revoked = false;
  @observable scopes: Set<string>;
  user: User; // TODO: figure out whether this should go into store.
  userId: number;

  constructor(client: ClientJSON) {
    this.id = client.id;
    this.name = client.name;
    this.scopes = new Set(client.scopes);
    this.userId = client.user_id;
    this.user = client.user;
  }

  @action
  async revoke() {
    this.isRevoking = true;

    return $.ajax({
      method: 'DELETE',
      url: route('oauth.authorized-clients.destroy', { authorized_client: this.id }),
    }).then(() => {
      this.revoked = true;
    }).always(() => {
      this.isRevoking = false;
    });
  }
}
