// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import LegacyPmNotification from 'models/legacy-pm-notification';
import { nameToIcons } from 'notification-maps/icons';
import Item from 'notification-widget/item';
import * as React from 'react';

@observer
export default class LegacyPm extends React.Component {
  handleMarkAsRead: any;
  render() {
    const item = new LegacyPmNotification();

    if (item.count === 0) return null;

    return (
      <Item
        icons={nameToIcons.legacy_pm}
        item={item}
        message={osu.transChoice('notifications.item.legacy_pm.legacy_pm.legacy_pm', item.count)}
        modifiers={['one']}
        url='/forum/ucp.php?i=pm&folder=inbox'
        withCategory
        withCoverImage
      />
    );
  }
}
