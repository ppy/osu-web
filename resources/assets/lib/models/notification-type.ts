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

import { NotificationTypeJson } from 'interfaces/notification-json';
import { action, observable } from 'mobx';
import NotificationStack from 'models/notification-stack';
import { NotificationContextData } from 'notifications-context';
import core from 'osu-core-singleton';
import NotificationStackStore from 'stores/notification-stack-store';

export type Name = null | 'beatmapset' | 'build' | 'channel' | 'forum_topic' | 'news_post' | 'user';
const names: Name[] = [null, 'beatmapset', 'build', 'channel', 'forum_topic', 'news_post', 'user'];

export function getValidName(value: unknown) {
  const casted = value as Name;
  if (names.indexOf(casted) > -1) {
    return casted;
  }

  return names[0];
}

export default class NotificationType {
  @observable cursor: JSON | null = null;
  @observable isLoading = false;
  @observable isMarkingAsRead = false;
  @observable stacks = new Map<string, NotificationStack>();
  @observable total = 0;

  constructor(private readonly store: NotificationStackStore, readonly name: string) {}

  @action
  loadMore(context: NotificationContextData) {
    if (this.cursor == null) { return; }

    this.isLoading = true;
    this.store.loadMore(this.cursor, context)
    .always(action(() => {
      this.isLoading = false;
    }));
  }

  @action
  markTypeAsRead() {
    core.dataStore.notificationStore.queueMarkTypeAsRead(this);
  }

  @action
  removeStack(stack: NotificationStack) {
    const exists = this.stacks.delete(stack.id);
    if (exists) this.total -= stack.total;
    return exists;
  }

  @action
  updateWithJson(json: NotificationTypeJson) {
    this.cursor = json.cursor;
    this.total = json.total;
  }
}
