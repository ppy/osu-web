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

import { action, computed, observable } from 'mobx';
import { getValidName, Name as NotificationTypeName } from 'models/notification-type';
import { NotificationContextData } from 'notifications-context';
import NotificationStackStore from 'stores/notification-stack-store';
import NotificationStore from 'stores/notification-store';

export default class NotificationController {
  @observable currentFilter: NotificationTypeName;

  private store: NotificationStackStore;

  @computed
  get legacyPm() {
    return this.store.legacyPm;
  }

  @computed
  get stacks() {
    return this.store.orderedStacksOfType(this.currentFilter);
  }

  @computed
  get type() {
    return this.store.getOrCreateType({ objectType: this.currentFilter });
  }

  private get typeNameFromUrl() {
    const url = new URL(location.href);

    return getValidName(url.searchParams.get('type'));
  }

  constructor(
    readonly notificationStore: NotificationStore,
    protected readonly contextType: NotificationContextData,
    filter?: NotificationTypeName,
  ) {
    // TODO: should probably not infer from url here.
    this.currentFilter = filter !== undefined ? filter : this.typeNameFromUrl;

    this.store = contextType.isWidget ? notificationStore.unreadStacks : notificationStore.stacks;
  }

  @action
  loadMore() {
    this.type?.loadMore(this.contextType);
  }

  @action
  navigateTo(type: NotificationTypeName) {
    this.currentFilter = type;

    if ([...this.stacks].length === 0) {
      this.loadMore();
    }

    if (!this.contextType.isWidget) {
      let href: string;
      if (type == null) {
        const url = new URL(window.location.href);
        url.searchParams.delete('type');

        href = url.href;
      } else {
        href = osu.updateQueryString(null, { type });
      }

      Turbolinks.controller.advanceHistory(href);
    }
  }
}
