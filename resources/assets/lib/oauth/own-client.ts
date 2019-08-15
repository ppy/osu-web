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

import { action } from 'mobx';
import { Client } from 'oauth/client';
import { OwnClientJSON } from 'oauth/own-client-json';

export class OwnClient extends Client {
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
      url: laroute.route('oauth.own-clients.destroy', { own_client: this.id }),
    }).then(() => {
      this.revoked = true;
    }).always(() => {
      this.isRevoking = false;
    });
  }
}
