// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  count: number;
  type?: string;
}

@observer
export default class NotificationIcon extends React.Component<Props> {
  render() {
    const modifiers = {
      glow: this.props.count > 0,
      mobile: this.props.type === 'mobile',
    };

    return (
      <span className={classWithModifiers('notification-icon', modifiers)}>
        <i className='fas fa-comment-alt' />
        <span className='notification-icon__count'>
          {this.unreadCountDisplay()}
        </span>
      </span>
    );
  }

  private unreadCountDisplay() {
    if (core.notificationsWorker.hasData) {
      // combination of latency and delays processing marking as read can cause the display count to go negative.
      const count = this.props.count > 0 ? this.props.count : 0;
      return osu.formatNumber(count);
    } else {
      return '...';
    }
  }
}
