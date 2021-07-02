// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { UserLoginAction } from 'actions/user-login-actions';
import { dispatch } from 'app-dispatcher';
import { route } from 'laroute';

export default class UserLoginObserver {
  constructor() {
    $(document)
      .on('ajax:success', '.js-logout-link', this.handleUserLogout)
      .on('ajax:success', '.js-login-form', this.handleUserLogin);
  }

  logout(redirect = false) {
    localStorage.clear();

    if (redirect) {
      location.href = route('home');
    } else {
      location.reload();
    }
  }

  private handleUserLogin = () => {
    dispatch(new UserLoginAction());
  };

  private handleUserLogout = (event: JQuery.TriggeredEvent<unknown, unknown, HTMLElement, unknown>) => {
    const redirect = !!(event.currentTarget.dataset.redirectHome);
    this.logout(redirect);
  };
}
