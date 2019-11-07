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

import HeaderV3 from 'header-v3';
import { route } from 'laroute';
import Notification from 'models/notification';
import { nameToIcons } from 'notification-maps/icons';
import { formatMessage } from 'notification-maps/message';
import { urlSingular } from 'notification-maps/url';
import Item from 'notification-widget/item';
import * as React from 'react';

interface Props {
  notifications: Notification[];
}

export class Main extends React.PureComponent<Props> {
  static defaultProps = {
    user: currentUser,
  };

  static readonly links = [
    { title: 'All', url: route('notifications.index'), active: true },
    { title: 'Profile', url: route('notifications.index') },
    { title: 'Beatmaps', url: route('notifications.index') },
    { title: 'Forum', url: route('notifications.index') },
  ];

  render() {
    return (
      <div className='osu-layout osu-layout--full'>
        <HeaderV3
          links={Main.links}
          theme='users'
          titleTrans={{
            info: 'History',
            key: 'Notifications',
          }}
        />

        <div className='osu-page osu-page--users'>
          {this.props.notifications.map(this.renderNotification)}
        </div>
      </div>
    );
  }

  renderNotification(notification: Notification) {
    try {
      return (
        <Item
          icons={nameToIcons[notification.name || '']}
          item={notification}
          message={formatMessage(notification)}
          modifiers={['one']}
          url={urlSingular(notification)}
          withCategory={true}
          withCoverImage={true}
        />
      );
    } catch (error) {
      console.log(notification);
      return error.message;
    }
  }
}
