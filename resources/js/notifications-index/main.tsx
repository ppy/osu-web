// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'components/header-v4';
import ShowMoreLink from 'components/show-more-link';
import HeaderLink from 'interfaces/header-link';
import { route } from 'laroute';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import { Name as NotificationTypeName, typeNames } from 'models/notification-type';
import Stack from 'notification-widget/stack';
import NotificationController from 'notifications/notification-controller';
import NotificationDeleteButton from 'notifications/notification-delete-button';
import NotificationReadButton from 'notifications/notification-read-button';
import { NotificationContext, NotificationContextData } from 'notifications-context';
import core from 'osu-core-singleton';
import * as React from 'react';
import { trans } from 'utils/lang';

@observer
export class Main extends React.Component {
  static readonly contextType = NotificationContext;
  declare context: React.ContextType<typeof NotificationContext>;

  private readonly controller: NotificationController;

  @computed
  get links(): HeaderLink[] {
    return typeNames.map((name) => ({
      active: this.controller.currentFilter === name,
      data: { 'data-type': name },
      title: trans(`notifications.filters.${name ?? '_'}`),
      url: route('notifications.index', { type: name }),
    }));
  }

  private get type() {
    return this.controller.type;
  }

  constructor(props: Record<string, never>, context: NotificationContextData) {
    super(props);

    this.controller = new NotificationController(core.dataStore.notificationStore, context);

    makeObservable(this);
  }

  render() {
    return (
      <div className='osu-layout osu-layout--full'>
        <HeaderV4
          links={this.links}
          onLinkClick={this.handleLinkClick}
          theme='notifications'
        />

        <div className='osu-page osu-page--generic-compact'>
          <div className='notification-index'>
            {!this.type.isEmpty &&
              <div className='notification-index__actions'>
                {this.renderMarkAsReadButton()}
                {this.renderDeleteButton()}
              </div>
            }

            {this.type.isEmpty
              ? this.type.isLoading
                ? null
                : trans('notifications.none')
              : this.renderStacks()
            }

            {this.renderShowMore()}
          </div>
        </div>
      </div>
    );
  }

  renderShowMore() {
    return (
      <ShowMoreLink
        callback={this.handleShowMore}
        hasMore={this.type.hasMore}
        loading={this.type.isLoading}
        modifiers='notification-group'
      />
    );
  }

  renderStacks() {
    return (
      <div className='notification-stacks'>
        {this.controller.stacks.map((stack) => (
          <Stack key={stack.id} stack={stack} />
        ))}
      </div>
    );
  }

  private readonly handleDelete = () => {
    this.type.delete();
  };

  private readonly handleLinkClick = (event: React.MouseEvent<HTMLAnchorElement>) => {
    event.preventDefault();

    const type = ((event.currentTarget as HTMLAnchorElement).dataset.type ?? null) as NotificationTypeName;
    this.controller.navigateTo(type);
  };

  private readonly handleMarkAsRead = () => {
    this.controller.markCurrentTypeAsRead();
  };

  private readonly handleShowMore = () => {
    this.controller.loadMore();
  };

  private renderDeleteButton() {
    return (
      <NotificationDeleteButton
        isDeleting={this.type.isDeleting}
        onDelete={this.handleDelete}
        text={trans('notifications.delete', { type: trans(`notifications.action_type.${this.type.name ?? '_'}`) })}
      />
    );
  }

  private renderMarkAsReadButton() {
    return (
      <NotificationReadButton
        isMarkingAsRead={this.controller.isMarkingCurrentTypeAsRead}
        onMarkAsRead={this.handleMarkAsRead}
        text={trans('notifications.mark_read', { type: trans(`notifications.action_type.${this.type.name ?? '_'}`) })}
      />
    );
  }
}
