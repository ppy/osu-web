// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import Worker from 'notifications/worker';
import * as React from 'react';

interface Props {
  type?: string;
  worker: Worker;
}

@observer
export default class NotificationIcon extends React.Component<Props> {
  render() {
    if (!this.props.worker.isActive()) {
      return null;
    }

    return (
      <span className={this.mainClass()}>
        <i className='fas fa-inbox' />
        <span className='notification-icon__count'>
          {this.unreadCount()}
        </span>
      </span>
    );
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

  private unreadCount() {
    if (this.props.worker.hasData) {
      return osu.formatNumber(this.props.worker.unreadCount);
    } else {
      return '...';
    }
  }
}
