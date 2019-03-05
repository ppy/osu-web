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
import * as React from 'react';
import NotificationStore from './stores/notification-store';
import { observer } from "mobx-react";

interface NotificationProps {
  store: NotificationStore;
}

@observer
export default class NotificationWidget extends React.Component<NotificationProps, {}> {
  public componentDidMount() {
    this.props.store.boot();
  }

  public componentWillUnmount() {
    this.props.store.destroy();
  }

  public render() {
    if (currentUser.id == null) {
      return <div />;
    }

    return <>
      <button className='nav-button nav-button--stadium'>
        <span className={this.mainClass()}>
          <i className='fas fa-inbox' />
          <span className='notification-icon__count'>
            {this.unreadCount()}
          </span>
        </span>
      </button>
      <div className='nav-click-popup'>
      </div>
    </>;
  }

  private mainClass() {
    let ret = 'notification-icon';

    if (this.props.store.unreadCount > 0) {
      ret += ' notification-icon--glow';
    }

    return ret;
  }

  private unreadCount() {
    if (this.props.store.hasData) {
      return osu.formatNumber(this.props.store.unreadCount);
    } else {
      return '...';
    }
  }
}
