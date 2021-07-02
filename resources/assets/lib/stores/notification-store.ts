// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DispatcherAction from 'actions/dispatcher-action';
import { UserLoginAction } from 'actions/user-login-actions';
import { dispatchListener } from 'app-dispatcher';
import DispatchListener from 'dispatch-listener';
import { action, observable } from 'mobx';
import Notification from 'models/notification';
import { NotificationEventDelete, NotificationEventRead } from 'notifications/notification-events';
import { NotificationIdentity, resolveIdentityType, resolveStackId } from 'notifications/notification-identity';
import NotificationStackStore from './notification-stack-store';
import WidgetNotificationStackStore from './widget-notification-stack-store';

type NotificationEachCallback = (notification: Notification) => void;

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
    if (dispatched instanceof NotificationEventDelete) {
      this.handleNotificationEventDelete(dispatched);
    } else if (dispatched instanceof NotificationEventRead) {
      this.handleNotificationEventRead(dispatched);
    } else if (dispatched instanceof UserLoginAction) {
      this.flushStore();
    }
  }

  @action
  handleNotificationEventDelete(event: NotificationEventDelete) {
    this.eachByEvent(event, (notification) => {
      this.notifications.delete(notification.id);
    });
  }

  @action
  handleNotificationEventRead(event: NotificationEventRead) {
    this.eachByEvent(event, (notification) => {
      notification.isRead = true;
    });
  }

  private eachByEvent(event: NotificationEventDelete | NotificationEventRead, callback: NotificationEachCallback) {
    for (const identity of event.data) {
      const identityType = resolveIdentityType(identity);

      switch (identityType) {
        case 'type':
          this.eachByType(identity, callback);
          break;

        case 'stack':
          this.eachByStack(identity, callback);
          break;

        case 'notification':
          if (identity.id == null) return;
          const notification = this.get(identity.id);

          if (notification != null) {
            callback(notification);
          }
          break;
      }
    }
  }

  private eachByStack(identity: NotificationIdentity, callback: NotificationEachCallback) {
    const stackId = resolveStackId(identity);

    this.notifications.forEach((notification) => {
      if (notification.stackId === stackId) {
        callback(notification);
      }
    });
  }

  private eachByType(identity: NotificationIdentity, callback: NotificationEachCallback) {
    this.notifications.forEach((notification) => {
      if (identity.objectType == null || notification.objectType === identity.objectType) {
        callback(notification);
      }
    });
  }
}
