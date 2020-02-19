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
import { dispatchListener } from 'app-dispatcher';
import DispatchListener from 'dispatch-listener';
import { action, observable } from 'mobx';
import Notification from 'models/notification';
import NotificationStackStore from './notification-stack-store';
import WidgetNotificationStackStore from './widget-notification-stack-store';

@dispatchListener
export default class NotificationStore implements DispatchListener {
  @observable notifications = new Map<number, Notification>();
  readonly stacks = new NotificationStackStore(this);
  readonly unreadStacks = new WidgetNotificationStackStore(this);

  @action
  add(notification: Notification) {
    this.notifications.set(notification.id, notification);
  }

  @action
  flushStore() {
    this.notifications.clear();
  }

  get(id: number) {
    return this.notifications.get(id);
  }

  @action
  handleDispatchAction(dispatched: DispatcherAction) {
    if (dispatched instanceof UserLoginAction || dispatched instanceof UserLogoutAction) {
      this.flushStore();
    }
  }
}
