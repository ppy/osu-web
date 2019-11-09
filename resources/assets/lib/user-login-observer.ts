/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import { UserLoginAction, UserLogoutAction } from 'actions/user-login-actions';
import Dispatcher from './dispatcher';

export default class UserLoginObserver {
  private dispatcher: Dispatcher;

  constructor(window: Window, dispatcher: Dispatcher) {
    this.dispatcher = dispatcher;
    $(window.document).on('ajax:success', '.js-logout-link', this.userLogout);
    $(window.document).on('ajax:success', '.js-login-form', this.userLogin);
  }

  userLogin = () => {
    this.dispatcher.dispatch(new UserLoginAction());
  }

  userLogout = () => {
    this.dispatcher.dispatch(new UserLogoutAction());
  }
}
