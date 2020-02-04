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

    return (
      <Item
        icons={nameToIcons.legacy_pm}
        item={item}
        message={osu.transChoice('notifications.item.legacy_pm.legacy_pm.legacy_pm', item.count)}
        modifiers={['one']}
        url='/forum/ucp.php?i=pm&folder=inbox'
        withCategory={true}
        withCoverImage={true}
      />
    );
  }
}
