// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { UserLoginAction, UserLogoutAction } from 'actions/user-login-actions';
import { dispatch } from 'app-dispatcher';

export default class UserLoginObserver {
  constructor() {
    $(document)
      .on('ajax:success', '.js-logout-link', this.userLogout)
      .on('ajax:success', '.js-login-form', this.userLogin);
  }

  userLogin = () => {
    dispatch(new UserLoginAction());
  };

  userLogout = () => {
    dispatch(new UserLogoutAction());
  };
}
