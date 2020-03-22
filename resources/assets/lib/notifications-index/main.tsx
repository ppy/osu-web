// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'header-v4';
import HeaderLink from 'interfaces/header-link';
import { route } from 'laroute';
import { observe } from 'mobx';
import { observer } from 'mobx-react';
import { Name as NotificationTypeName, TYPES } from 'models/notification-type';
import Stack from 'notification-widget/stack';
import { NotificationContext, NotificationContextData } from 'notifications-context';
import LegacyPm from 'notifications/legacy-pm';
import NotificationController from 'notifications/notification-controller';
import core from 'osu-core-singleton';
import * as React from 'react';
import { ShowMoreLink } from 'show-more-link';

@observer
export class Main extends React.Component {
  static readonly contextType = NotificationContext;

  readonly links: HeaderLink[];

  private readonly controller: NotificationController;

  constructor(props: {}, context: NotificationContextData) {
    super(props, context);

    this.controller = new NotificationController(core.dataStore.notificationStore, this.context);
    this.links = TYPES.map((obj) => {
      const type = obj.type;
      return {
        active: this.controller.currentFilter === obj.type,
        data: { 'data-type': type },
        title: osu.trans(`notifications.filters.${type ?? '_'}`),
        url: route('notifications.index', { type }),
      };
    });

    observe(this.controller, 'currentFilter', (change) => {
      this.links.forEach((link) => {
        link.active = link.data['data-type'] === change.newValue;
      });
    });
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

  private handleLinkClick = (event: React.MouseEvent<HTMLAnchorElement>) => {
    event.preventDefault();

    const type = ((event.currentTarget as HTMLAnchorElement).dataset.type ?? null) as NotificationTypeName;
    this.controller.navigateTo(type);
  }

  private handleShowMore = () => {
    this.controller.loadMore();
  }
}
