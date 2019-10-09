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

import { OwnClientJSON } from 'interfaces/own-client-json';
import { route } from 'laroute';
import { action, observable } from 'mobx';
import { Client } from 'models/oauth/client';

export class OwnClient extends Client {
  @observable isUpdating = false;
  redirect: string;
  secret: string;

  constructor(client: OwnClientJSON) {
    super(client);

    this.redirect = client.redirect;
    this.secret = client.secret;
  }

  @action
  async delete() {
    this.isRevoking = true;

    return $.ajax({
      method: 'DELETE',
      url: route('oauth.clients.destroy', { client: this.id }),
    }).then(() => {
      this.revoked = true;
    }).always(() => {
      this.isRevoking = false;
    });
  }

  @action
  updateFromJson(json: OwnClientJSON) {
    this.id = json.id;
    this.name = json.name;
    this.scopes = new Set(json.scopes);
    this.userId = json.user_id;
    this.user = json.user;
    this.redirect = json.redirect;
    this.secret = json.secret;
  }

  @action
  async updateWith(partial: Partial<OwnClient>) {
    const { redirect } = partial;
    this.isUpdating = true;

    return $.ajax({
      data: { redirect },
      method: 'PUT',
      url: route('oauth.clients.update', { client: this.id }),
    }).then((data: OwnClientJSON) => {
      this.updateFromJson(data);
    }).always(() => {
      this.isUpdating = false;
    });
  }
}
