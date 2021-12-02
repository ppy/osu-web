// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import AdminMenuItem from 'interfaces/admin-menu-item';
import core from 'osu-core-singleton';
import * as React from 'react';
import { nextVal } from 'utils/seq';

interface Props {
  items: AdminMenuItem[];
}

export default class AdminMenu extends React.PureComponent<Props> {
  private eventId = `admin-menu-${nextVal()}`;

  render() {
    if (core.currentUser?.is_admin ?? false) {
      return null;
    }

    const items = this.props.items.map((item) => (
      <item.component key={`${item.icon}-${item.text}`} className='admin-menu-item' {...item.props}>
        <span className='admin-menu-item__content'>
          <span className='admin-menu-item__label admin-menu-item__label--icon'>
            <span className={item.icon} />
          </span>

          <span className='admin-menu-item__label admin-menu-item__label--text'>
            {item.text}
          </span>
        </span>
      </item.component>
    ));

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
