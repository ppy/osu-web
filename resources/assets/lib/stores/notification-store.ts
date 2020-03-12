// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
