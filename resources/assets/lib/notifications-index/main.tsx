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
import { observer } from 'mobx-react';
import TypeGroup from 'notification-widget/type-group';
import core from 'osu-core-singleton';
import * as React from 'react';

@observer
export class Main extends React.Component {
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
          {this.renderTypeGroups()}
        </div>
      </div>
    );
  }

  renderTypeGroups() {
    const items: React.ReactNode[] = [];

    core.dataStore.notificationStore.itemsGroupedByType.forEach((value, key) => {
      if (value.length === 0) {
        return;
      }

      items.push(
        (
          <div key={key} className='notification-popup__item'>
            <TypeGroup
              item={value[0]}
              items={value}
            />
          </div>
        ),
      );
    });

    return items;
  }
}
