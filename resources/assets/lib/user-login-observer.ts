// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { UserLoginAction } from 'actions/user-login-actions';
import { dispatch } from 'app-dispatcher';
import { route } from 'laroute';

export default class UserLoginObserver {
  constructor() {
    $(document)
      .on('ajax:success', '.js-logout-link', this.userLogout)
      .on('ajax:success', '.js-login-form', this.userLogin);
  }

  userLogin = () => {
    dispatch(new UserLoginAction());
  };

  userLogout = (event: JQuery.TriggeredEvent<unknown, unknown, HTMLElement, unknown>) => {
    localStorage.clear();
    const redirect = !!(event.currentTarget.dataset.redirectHome);

    if (redirect) {
      location.href = route('home');
    } else {
      location.reload();
    }
  };
}
