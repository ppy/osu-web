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

import AdminMenuItem from 'interfaces/admin-menu-item';
import * as React from 'react';

interface Props {
  items: AdminMenuItem[];
}

export default class AdminMenu extends React.PureComponent<Props> {
  private eventId = `admin-menu-${osu.uuid()}`;

  render() {
    if (currentUser.id == null || !currentUser.is_admin) {
      return null;
    }

    const items = this.props.items.map((item) => {
      return (
        <item.component className='admin-menu-item' key={`${item.icon}-${item.text}`} {...item.props}>
          <span className='admin-menu-item__content'>
            <span className='admin-menu-item__label admin-menu-item__label--icon'>
              <span className={item.icon} />
            </span>

            <span className='admin-menu-item__label admin-menu-item__label--text'>
              {item.text}
            </span>
          </span>
        </item.component>
      );
    });

    return (
      <div className='admin-menu'>
        <button className='admin-menu__button js-menu' data-menu-target={`admin-menu-${this.eventId}`}>
          <span className='fas fa-angle-up' />
          <span className='admin-menu__button-icon fas fa-tools' />
        </button>
        <div
          className='admin-menu__menu js-menu'
          data-menu-id={`admin-menu-${this.eventId}`}
          data-visibility='hidden'
        >
          {items}
        </div>
      </div>
    );
  }
}
