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
import { NotificationContext } from 'notifications-context';
import core from 'osu-core-singleton';
import * as React from 'react';
import TypeGroup from './type-group';
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
  readonly state = {
    hasError: false,
  };

  private menuId = `nav-notification-popup-${osu.uuid()}`;
  private readonly store = core.dataStore.notificationStore.unreadStacks;

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
      <NotificationContext.Provider value={{ unreadOnly: true }}>
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
              {this.renderTypeGroups()}
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

  private renderTypeGroups() {
    if (this.state.hasError) {
      return;
    }

    const nodes: React.ReactNode[] = [];

    this.store.types.forEach((type) => {
      if (!type.hasVisibleNotifications) {
        return;
      }

      nodes.push(<TypeGroup key={type.name} type={type} canShowMore={false} />);
    });

    if (nodes.length === 0) {
      nodes.push(this.props.worker.hasMore ? (
        <div key='empty-with-more' className='notification-popup__empty-with-more' />
      ) : (
        <p key='empty' className='notification-popup__empty'>
          {osu.trans('notifications.all_read')}
        </p>
      ));
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
