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

import * as _ from 'lodash';
import * as React from 'react';
import { PopupMenuPersistent } from '../popup-menu-persistent';
import { SlateContext } from './slate-context';

export interface MenuItem {
  icon: JSX.Element;
  id: string;
  label: string;
}

interface Props {
  disabled?: boolean;
  menuOptions: MenuItem[];
  onSelect: (id: string) => void;
  selected: string | number;
}

export default class IconDropdownMenu extends React.Component<Props> {
  static contextType = SlateContext;

  render(): React.ReactNode {
    return (
      <PopupMenuPersistent customRender={this.renderButton}>
        {() => {
          return (
            <div className='simple-menu simple-menu--popup-menu-compact'>
              {this.props.menuOptions.map((item) => this.renderMenuItem(item))}
            </div>
            );
        }}
      </PopupMenuPersistent>
    );
  }

  renderButton = (children: JSX.Element[], ref: React.RefObject<HTMLDivElement>, toggle: (event: React.MouseEvent<HTMLElement>) => void) => {
    const selected: MenuItem = _.find(this.props.menuOptions, (option) => option.id === this.props.selected) || this.props.menuOptions[0];
    let classes = 'beatmap-discussion-editor__dropdown';

    if (this.props.disabled) {
      toggle = () => { /* do nothing */ };
      classes += ' beatmap-discussion-editor__dropdown--disabled';
    }

    return (
      <div
        className={classes}
        contentEditable={false} // workaround for slatejs 'Cannot resolve a Slate point from DOM point' nonsense
        onClick={toggle}
        ref={ref}
      >
        {selected.icon}
        {children}
      </div>
    );
  }

  renderMenuItem = (menuItem: MenuItem) => {
    let menuItemClasses = 'simple-menu__item';

    if (menuItem.id === this.props.selected) {
      menuItemClasses += ' simple-menu__item--active';
    }

    return (
      <button
        className={menuItemClasses}
        key={menuItem.id}
        data-id={menuItem.id}
        onClick={this.select}
      >
        {menuItem.icon}
        <div className='simple-menu__label'>
          {menuItem.label}
        </div>
      </button>
    );
  }

  select = (event: React.MouseEvent<HTMLElement>) => {
    event.preventDefault();

    const target = event.currentTarget as HTMLElement;

    if (!target) {
      return;
    }

    this.props.onSelect(`${target.dataset.id}`);
  }
}
