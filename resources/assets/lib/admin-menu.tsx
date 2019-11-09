/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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
