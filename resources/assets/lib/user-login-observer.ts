// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { UserLoginAction, UserLogoutAction } from 'actions/user-login-actions';
import { dispatch } from 'app-dispatcher';
import core from 'osu-core-singleton';

export default class UserLoginObserver {
  constructor() {
    $(document)
      .on('ajax:success', '.js-logout-link', this.userLogout)
      .on('ajax:success', '.js-login-form', this.userLogin);
  }

  userLogin = () => {
    dispatch(new UserLoginAction());
  };

  userLogout = (event: JQuery.Event, data?: { captcha_triggered?: boolean }) => {
    localStorage.clear();

    osu.reloadPage();

    if (data?.captcha_triggered === true) {
      core.captcha.trigger();
    } else {
      core.captcha.untrigger();
    }

    dispatch(new UserLogoutAction());
  };
}
