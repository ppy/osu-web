// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ClientJson } from 'interfaces/client-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { action, makeObservable, observable } from 'mobx';

export class Client {
  id: number;
  @observable isRevoking = false;
  name: string | null;
  @observable revoked = false;
  @observable scopes: Set<string>;
  user: UserJson; // TODO: figure out whether this should be converted to User and go into store.
  userId: number;

  constructor(client: ClientJson) {
    this.id = client.id;
    this.name = client.name;
    this.scopes = new Set(client.scopes);
    this.userId = client.user_id;
    this.user = client.user;

    makeObservable(this);
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
