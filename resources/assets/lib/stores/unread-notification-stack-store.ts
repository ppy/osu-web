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
import { autorun } from 'mobx';
import core from 'osu-core-singleton';
import NotificationStackStore from './notification-stack-store';
import RootDataStore from './root-data-store';

export default class UnreadNotificationStackStore extends NotificationStackStore {
  constructor(protected root: RootDataStore, protected dispatcher: Dispatcher) {
    super(root, dispatcher);

    autorun(() => {
      this.root.notificationsRead.forEach((notification) => {
        const stack = this.stacks.get(notification.stackId);
        if (stack?.remove(notification)) {
          core.dataStore.notificationStore.unreadCount--;
          stack.total--;
        }
      });
    });
  }
}
