// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { action, computed, makeObservable, observable } from 'mobx';
import NotificationType, { getValidName, Name as NotificationTypeName, typeNames } from 'models/notification-type';
import { NotificationContextData } from 'notifications-context';
import NotificationStackStore from 'stores/notification-stack-store';
import NotificationStore from 'stores/notification-store';
import { updateHistory, currentUrl, currentUrlParams } from 'utils/turbolinks';
import { updateQueryString } from 'utils/url';

export default class NotificationController {
  @observable currentFilter: NotificationTypeName;

  private readonly store: NotificationStackStore;
  private readonly typeNamesWithoutNull;

  @computed
  get isMarkingCurrentTypeAsRead() {
    return this.getNonNullTypes(this.type).some((type) => type.isMarkingAsRead);
  }

  @computed
  get stacks() {
    return this.store.orderedStacksOfType(this.currentFilter).filter((stack) => stack.hasVisibleNotifications && !this.isExcluded(stack.objectType));
  }

  @computed
  get type() {
    return this.getType(this.currentFilter);
  }

  private get typeNameFromUrl() {
    return getValidName(currentUrlParams().get('type'));
  }

  constructor(
    readonly notificationStore: NotificationStore,
    protected readonly contextType: NotificationContextData,
    filter?: NotificationTypeName,
  ) {
    this.typeNamesWithoutNull = typeNames.filter((name) => !(name == null || this.isExcluded(name)));

    // TODO: should probably not infer from url here.
    this.currentFilter = filter !== undefined ? filter : this.typeNameFromUrl;

    this.store = contextType.isWidget ? notificationStore.unreadStacks : notificationStore.stacks;

    makeObservable(this);
  }

  getTotal(type: NotificationType) {
    return this.getNonNullTypes(type).reduce((acc, current) => acc + current.total, 0);
  }

  readonly getType = (name: NotificationTypeName) => this.store.getOrCreateType({ objectType: name });

  @action
  loadMore() {
    this.type?.loadMore(this.contextType);
  }

  @action
  markCurrentTypeAsRead() {
    this.getNonNullTypes(this.type).forEach((type) => {
      type.markTypeAsRead();
    });
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
        href = updateQueryString(null, { type });
      }

      updateHistory(href, 'advance');
    }
  }

  private getNonNullTypes(type: NotificationType) {
    if (type.name != null) {
      return [type];
    }

    return this.typeNamesWithoutNull.map(this.getType);
  }

  private isExcluded(name: NotificationTypeName) {
    return this.contextType.excludes.includes(name);
  }
}
