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

import { route } from 'laroute';
import * as _ from 'lodash';
import { observer } from 'mobx-react';
import { Name, TYPES } from 'models/notification-type';
import { NotificationContext } from 'notifications-context';
import LegacyPm from 'notifications/legacy-pm';
import NotificationController from 'notifications/notification-controller';
import core from 'osu-core-singleton';
import * as React from 'react';
import { ShowMoreLink } from 'show-more-link';
import Stack from './stack';

interface Props {
  extraClasses?: string;
}

interface State {
  hasError: boolean;
}

@observer
export default class Main extends React.Component<Props, State> {
  readonly links = TYPES.map((obj) => {
    const type = obj.type;
    return { title: osu.trans(`notifications.filters.${type ?? '_'}`), data: { 'data-type': type }, type };
  });

  readonly state = {
    hasError: false,
  };

  private readonly controller = new NotificationController(core.dataStore.notificationStore, { isWidget: true }, null);

  static getDerivedStateFromError(error: Error) {
    // tslint:disable-next-line: no-console
    console.error(error);
    return { hasError: true };
  }

  render() {
    const blockClass = `notification-popup u-fancy-scrollbar ${this.props.extraClasses ?? ''}`;

    return (
      <NotificationContext.Provider value={{ isWidget: true }}>
        <div className={blockClass}>
          <div className='notification-popup__scroll-container'>
            {this.renderFilters()}
            {this.renderHistoryLink()}
            {this.renderLegacyPm()}
            <div className='notification-stacks'>
              {this.renderStacks()}
              {this.renderShowMore()}
            </div>
          </div>
        </div>
      </NotificationContext.Provider>
    );
  }

  private handleFilterClick = (event: React.MouseEvent<HTMLButtonElement>) => {
    const type = ((event.currentTarget as HTMLButtonElement).dataset.type ?? null) as Name;
    this.controller.navigateTo(type);
  }

  private handleShowMore = () => {
    this.controller.loadMore();
  }

  private renderFilter = (link: any) => {
    const type = core.dataStore.notificationStore.unreadStacks.getOrCreateType({ objectType: link.type });
    const isSameFilter = link.type === this.controller.currentFilter;

    if (type.name !== null && type.isEmpty && !isSameFilter) return null;

    const data = { 'data-type': link.type };
    const modifiers = isSameFilter ? ['active'] : [];

    return (
      <button
        className={osu.classWithModifiers('notification-popup__filter', modifiers)}
        key={link.title}
        onClick={this.handleFilterClick}
        {...data}
      >
        <span className='notification-popup__filter-count'>{type.total}</span>
        <span>{link.title}</span>
      </button>
    );
  }

  private renderFilters() {
    return (
      <div className='notification-popup__filters'>
        {this.links.map(this.renderFilter)}
      </div>
    );
  }

  private renderHistoryLink() {
    return (
      <a className='notification-popup__filter' href={route('notifications.index')}>
        {osu.trans('notifications.see_all')}
      </a>
    );
  }

  private renderLegacyPm() {
    if (this.controller.currentFilter != null) return;

    return <LegacyPm />;
  }

  private renderShowMore() {
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

  private renderStacks() {
    if (this.state.hasError) {
      return;
    }

    const nodes: React.ReactNode[] = [];
    for (const stack of this.controller.stacks) {
      if (!stack.hasVisibleNotifications) continue;

      nodes.push(<Stack key={stack.id} stack={stack} />);
    }

    if (nodes.length === 0) {
      const transKey = this.controller.currentFilter == null ? 'notifications.all_read' : 'notifications.none';
      return (
        <p key='empty' className='notification-popup__empty'>
          {osu.trans(transKey)}
        </p>
      );
    }

    return nodes;
  }
}
