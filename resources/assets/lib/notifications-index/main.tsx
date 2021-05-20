// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'header-v4';
import HeaderLink from 'interfaces/header-link';
import { route } from 'laroute';
import { computed } from 'mobx';
import { observer } from 'mobx-react';
import { Name as NotificationTypeName, typeNames } from 'models/notification-type';
import Stack from 'notification-widget/stack';
import { NotificationContext, NotificationContextData } from 'notifications-context';
import LegacyPm from 'notifications/legacy-pm';
import NotificationController from 'notifications/notification-controller';
import NotificationDeleteButton from 'notifications/notification-delete-button';
import NotificationReadButton from 'notifications/notification-read-button';
import core from 'osu-core-singleton';
import * as React from 'react';
import ShowMoreLink from 'show-more-link';

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
      title: osu.trans(`notifications.filters.${name ?? '_'}`),
      url: route('notifications.index', { type: name }),
    }));
  }

  constructor(props: Record<string, never>, context: NotificationContextData) {
    super(props);

    this.controller = new NotificationController(core.dataStore.notificationStore, context);
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
            <div className='notification-index__actions'>
              {this.renderMarkAsReadButton()}
              {this.renderDeleteButton()}
            </div>

            {this.renderLegacyPm()}

            <div className='notification-stacks'>
              {this.renderStacks()}
              {this.renderShowMore()}
            </div>
          </div>
        </div>
      </div>
    );
  }

  renderLegacyPm() {
    if (this.controller.currentFilter != null) return;

    return <LegacyPm />;
  }

  renderShowMore() {
    const type = this.controller.type;

    return (
      <ShowMoreLink
        callback={this.handleShowMore}
        hasMore={type?.hasMore}
        loading={type?.isLoading}
        modifiers={['notification-group', 'notification-list']}
      />
    );
  }

  renderStacks() {
    const nodes: React.ReactNode[] = [];
    for (const stack of this.controller.stacks) {
      nodes.push(<Stack key={stack.id} stack={stack} />);
    }

    return nodes;
  }

  private handleDelete = () => {
    this.controller.type.delete();
  };

  private handleLinkClick = (event: React.MouseEvent<HTMLAnchorElement>) => {
    event.preventDefault();

    const type = ((event.currentTarget as HTMLAnchorElement).dataset.type ?? null) as NotificationTypeName;
    this.controller.navigateTo(type);
  };

  private handleMarkAsRead = () => {
    this.controller.markCurrentTypeAsRead();
  };

  private handleShowMore = () => {
    this.controller.loadMore();
  };

  private renderDeleteButton() {
    const type = this.controller.type;

    if (type.isEmpty) return null;

    return (
      <NotificationDeleteButton
        isDeleting={type.isDeleting}
        onDelete={this.handleDelete}
        text={osu.trans('notifications.delete', { type: osu.trans(`notifications.filters.${type.name ?? '_'}`) })}
      />
    );
  }

  private renderMarkAsReadButton() {
    const type = this.controller.type;

    if (type.isEmpty) return null;

    return (
      <NotificationReadButton
        isMarkingAsRead={type.isMarkingAsRead}
        onMarkAsRead={this.handleMarkAsRead}
        text={osu.trans('notifications.mark_read', { type: osu.trans(`notifications.filters.${type.name ?? '_'}`) })}
      />
    );
  }
}
