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
import Worker from './worker';

interface Props {
  type?: string;
  worker: Worker;
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
  private menuId = `nav-notification-popup-${osu.uuid()}`;

  static getDerivedStateFromError(error: Error) {
    // tslint:disable-next-line: no-console
    console.error(error);
    return { hasError: true };
  }

  render() {
    if (!this.props.worker.isActive()) {
      return null;
    }

    return (
      <NotificationContext.Provider value={{ isWidget: true }}>
        <button
          className={this.buttonClass()}
          data-click-menu-target={this.menuId}
        >
          <span className={this.mainClass()}>
            <i className='fas fa-inbox' />
            <span className='notification-icon__count'>
              {this.unreadCount()}
            </span>
          </span>
        </button>
        <div className='nav-click-popup'>
          <div
            className='notification-popup js-click-menu js-nav2--centered-popup u-fancy-scrollbar'
            data-click-menu-id={this.menuId}
            data-visibility='hidden'
          >
            <div className='notification-popup__scroll-container'>
              {this.renderFilters()}
              {this.renderLegacyPm()}
              <div className='notification-type-group__items'>
                {this.renderStacks()}
                {this.renderShowMore()}
              </div>
            </div>
          </div>
        </div>
      </NotificationContext.Provider>
    );
  }

  private buttonClass() {
    let ret = 'js-click-menu nav-button';

    if (this.props.type === 'mobile') {
      ret += ' nav-button--mobile';
    } else {
      ret += ' nav-button--stadium';
    }

    return ret;
  }

  private handleFilterClick = (event: React.MouseEvent<HTMLButtonElement>) => {
    const type = ((event.currentTarget as HTMLButtonElement).dataset.type ?? null) as Name;
    this.controller.navigateTo(type);
  }

  private handleShowMore = () => {
    this.controller.loadMore();
  }

  private mainClass() {
    let ret = 'notification-icon';

    if (this.props.worker.unreadCount > 0) {
      ret += ' notification-icon--glow';
    }

    if (this.props.type === 'mobile') {
      ret += ' notification-icon--mobile';
    }

    return ret;
  }

  private renderFilter = (link: any) => {
    const type = core.dataStore.notificationStore.unreadStacks.getOrCreateType({ objectType: link.type });
    const data = { 'data-type': link.type };
    const modifiers = link.type === this.controller.currentFilter ? ['active'] : [];

    return (
      <button
        className={osu.classWithModifiers('notification-popup__filter', modifiers)}
        key={link.title}
        onClick={this.handleFilterClick}
        {...data}
      >
        <span>{link.title}</span>
        <span className='notification-popup__filter-count'>{type.total}</span>
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

  private renderLegacyPm() {
    if (this.controller.currentFilter != null) return;

    return (
      <div className='notification-type-group__items notification-type-group__items--legacy_pm'>
        <LegacyPm />
      </div>
    );
  }

  private renderShowMore() {
    const type = this.controller.type;

    return (
      <ShowMoreLink
        callback={this.handleShowMore}
        hasMore={type?.hasMore}
        loading={type?.isLoading}
        modifiers={['notification-group']}
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
      return (
        <p key='empty' className='notification-popup__empty'>
          {osu.trans('notifications.all_read')}
        </p>
      );
    }

    return nodes;
  }

  private unreadCount() {
    if (this.props.worker.hasData) {
      return osu.formatNumber(this.props.worker.unreadCount);
    } else {
      return '...';
    }
  }
}
