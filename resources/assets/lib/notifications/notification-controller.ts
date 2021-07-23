// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { action, computed, observable } from 'mobx';
import NotificationType, { getValidName, Name as NotificationTypeName, typeNames } from 'models/notification-type';
import { NotificationContextData } from 'notifications-context';
import osu from 'osu-common';
import NotificationStackStore from 'stores/notification-stack-store';
import NotificationStore from 'stores/notification-store';
import { currentUrl, currentUrlParams } from 'utils/turbolinks';

export default class NotificationController {
  @observable currentFilter: NotificationTypeName;

  private store: NotificationStackStore;
  private readonly typeNamesWithoutNull = typeNames.filter((name) => !(name == null || this.isExcluded(name)));

  @computed
  get stacks() {
    return this.store.orderedStacksOfType(this.currentFilter).filter((stack) => stack.hasVisibleNotifications && !this.isExcluded(stack.objectType));
  }

  @computed
  get type() {
    return this.store.getOrCreateType({ objectType: this.currentFilter });
  }

  private get typeNameFromUrl() {
    return getValidName(currentUrlParams().get('type'));
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

  getTotal(type: NotificationType) {
    if (type.name == null) {
      return this.typeNamesWithoutNull.reduce((acc, current) => acc + this.store.getOrCreateType({ objectType: current }).total, 0);
    }

    return type.total;
  }

  getType(name: NotificationTypeName) {
    return this.store.getOrCreateType({ objectType: name });
  }

  @action
  loadMore() {
    this.type?.loadMore(this.contextType);
  }

  @action
  markCurrentTypeAsRead() {
    if (this.type.name == null) {
      for (const name of this.typeNamesWithoutNull) {
        this.store.getOrCreateType({ objectType: name }).markTypeAsRead();
      }
    } else {
      this.type.markTypeAsRead();
    }
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
        const url = new URL(currentUrl().href);
        url.searchParams.delete('type');

        href = url.href;
      } else {
        href = osu.updateQueryString(null, { type });
      }

      Turbolinks.controller.advanceHistory(href);
    }
  }

  private isExcluded(name: NotificationTypeName) {
    return this.contextType.excludes.includes(name);
  }
}
