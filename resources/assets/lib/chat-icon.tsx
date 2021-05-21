// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { computed } from 'mobx';
import { observer } from 'mobx-react';
import NotificationIcon from 'notification-icon';
import core from 'osu-core-singleton';
import * as React from 'react';

interface Props {
  type?: string;
}

@observer
export default class ChatIcon extends React.Component<Props> {
  @computed
  private get unreadCount() {
    return core.dataStore.notificationStore.unreadStacks.getOrCreateType({ objectType: 'channel' }).total;
  }

  render() {
    return <NotificationIcon count={this.unreadCount} iconClassName='fas fa-comment-alt' ready={core.notificationsWorker.hasData} type={this.props.type} />;
  }
}
