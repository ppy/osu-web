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

import Dispatcher from 'dispatcher';
import { NotificationBundleJson } from 'interfaces/notification-json';
import { action, autorun, observable, runInAction } from 'mobx';
import NotificationStackStore from './notification-stack-store';
import RootDataStore from './root-data-store';

export default class UnreadNotificationStackStore extends NotificationStackStore {
  @observable total = 0;

  constructor(protected root: RootDataStore, protected dispatcher: Dispatcher) {
    super(root, dispatcher);

    autorun(() => {
      this.root.notificationsRead.notifications.forEach((notification) => {
        const stack = this.stacks.get(notification.stackId);
        runInAction(() => {
          if (stack?.remove(notification)) {
            this.total--;
            stack.total--;
          }
        });
      });
    });

    autorun(() => {
      if (this.root.notificationsRead.stack == null) { return; }
      const stack = this.stacks.get(this.root.notificationsRead.stack.id);
      if (stack == null) { return; }

      runInAction(() => {
        this.total -= stack.total;
        this.stacks.delete(stack.id);
        this.types.get(stack.objectType)?.stacks.delete(stack.id);
      });
    });

    autorun(() => {
      if (this.root.notificationsRead.type == null) { return; }
      const type = this.types.get(this.root.notificationsRead.type.name);
      if (type == null) { return; }

      runInAction(() => {
        this.total -= type.total;
        this.types.delete(type.name);
      });
    });
  }

  @action
  updateWithBundle(bundle: NotificationBundleJson) {
    super.updateWithBundle(bundle);

    if (bundle.unread_count != null) {
      this.total = bundle.unread_count;
    }
  }
}
