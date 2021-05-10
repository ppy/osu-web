// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { computed } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';

interface Props {
  type?: string;
}

@observer
export default class ChatIcon extends React.Component<Props> {
  @computed
  private get unreadCount() {
    const count = core.dataStore.notificationStore.unreadStacks.getOrCreateType({ objectType: 'channel' }).total;

    return count > 0 ? count : 0;
  }

  render() {
    return (
      <span className={this.mainClass()}>
        <i className='fas fa-comment-alt' />
        <span className='notification-icon__count'>
          {this.unreadCountDisplay()}
        </span>
      </span>
    );
  }

  private mainClass() {
    let ret = 'notification-icon';

    if (this.unreadCount > 0) {
      ret += ' notification-icon--glow';
    }

    if (this.props.type === 'mobile') {
      ret += ' notification-icon--mobile';
    }

    return ret;
  }

  private unreadCountDisplay() {
    if (core.notificationsWorker.hasData) {
      return osu.formatNumber(this.unreadCount);
    } else {
      return '...';
    }
  }
}
