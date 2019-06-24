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

export default class TokenStore extends Store {
  @observable tokens = new Map<string, TokenJSON>();

  async fetchAll() {
    const response: TokenJSON[] = await $.get('/oauth/tokens');
    for (const token of response) {
      this.update(token);
    }
  }

  handleDispatchAction(dispatchedAction: DispatcherAction) {
    if (dispatchedAction instanceof UserLoginAction
      || dispatchedAction instanceof UserLogoutAction) {
      this.flushStore();
    }
  }

  async revoke(id: string) {
    await $.ajax({
      method: 'DELETE',
      url: '/oauth/tokens/' + id,
    });

    this.fetchAll();
  }

  @action
  private flushStore() {
    this.tokens.clear();
  }

  @action
  private update(token: TokenJSON) {
    this.tokens.set(token.id, token);
  }
}
