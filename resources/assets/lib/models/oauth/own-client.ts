// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { OwnClientJson } from 'interfaces/own-client-json';
import { route } from 'laroute';
import { action, observable } from 'mobx';
import { Client } from 'models/oauth/client';

export class OwnClient extends Client {
  @observable isResetting = false;
  @observable isUpdating = false;
  redirect: string;
  secret: string;

  constructor(client: OwnClientJson) {
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
  async resetSecret() {
    this.isResetting = true;

    return $.ajax({
      method: 'POST',
      url: route('oauth.clients.reset-secret', { client: this.id }),
    }).then((data: OwnClientJson) => {
      this.updateFromJson(data);
    }).always(() => {
      this.isResetting = false;
    });
  }

  @action
  updateFromJson(json: OwnClientJson) {
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
    }).then((data: OwnClientJson) => {
      this.updateFromJson(data);
    }).always(() => {
      this.isUpdating = false;
    });
  }
}
