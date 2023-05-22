// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { OwnClientJson } from 'interfaces/own-client-json';
import { route } from 'laroute';
import { action, computed, makeObservable, observable } from 'mobx';
import { Client } from 'models/oauth/client';

export class OwnClient extends Client {
  @observable isResetting = false;
  @observable isUpdating = false;
  secret: string;

  @observable private redirectOrig: string;

  @computed
  get redirect() {
    return this.redirectOrig.replace(/,/g, '\r\n');
  }

  constructor(client: OwnClientJson) {
    super(client);

    this.redirectOrig = client.redirect;
    this.secret = client.secret;

    makeObservable(this);
  }

  @action
  delete() {
    this.isRevoking = true;

    const xhr = $.ajax({
      method: 'DELETE',
      url: route('oauth.clients.destroy', { client: this.id }),
    }) as JQuery.jqXHR<void>;

    xhr.done(action(() => {
      this.revoked = true;
    })).always(action(() => {
      this.isRevoking = false;
    }));

    return xhr;
  }

  @action
  resetSecret() {
    this.isResetting = true;

    const xhr = $.ajax({
      method: 'POST',
      url: route('oauth.clients.reset-secret', { client: this.id }),
    }) as JQuery.jqXHR<OwnClientJson>;

    xhr.done((data) => {
      this.updateFromJson(data);
    }).always(action(() => {
      this.isResetting = false;
    }));

    return xhr;
  }

  @action
  updateFromJson(json: OwnClientJson) {
    this.id = json.id;
    this.name = json.name;
    this.scopes = new Set(json.scopes);
    this.userId = json.user_id;
    this.user = json.user;
    this.redirectOrig = json.redirect;
    this.secret = json.secret;
  }

  @action
  updateWith(partial: Partial<OwnClientJson>) {
    const { redirect } = partial;
    this.isUpdating = true;

    const xhr = $.ajax({
      data: { redirect },
      method: 'PUT',
      url: route('oauth.clients.update', { client: this.id }),
    }) as JQuery.jqXHR<OwnClientJson>;

    xhr.done((data) => {
      this.updateFromJson(data);
    }).always(action(() => {
      this.isUpdating = false;
    }));

    return xhr;
  }
}
