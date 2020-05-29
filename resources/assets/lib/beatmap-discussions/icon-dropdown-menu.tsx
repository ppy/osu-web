// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as _ from 'lodash';
import { PopupMenuPersistent } from 'popup-menu-persistent';
import * as React from 'react';
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
  selected: string;
}

export default class IconDropdownMenu extends React.Component<Props> {
  static contextType = SlateContext;

  render(): React.ReactNode {
    return (
      <PopupMenuPersistent customRender={this.renderButton}>
        {() => (
          <div className='simple-menu simple-menu--popup-menu-compact'>
            {this.props.menuOptions.map((item) => this.renderMenuItem(item))}
          </div>
        )}
      </PopupMenuPersistent>
    );
  }

  renderButton = (children: JSX.Element[], ref: React.RefObject<HTMLDivElement>, toggle: (event: React.MouseEvent<HTMLElement>) => void) => {
    const selected: MenuItem = _.find(this.props.menuOptions, (option) => option.id === this.props.selected) || this.props.menuOptions[0];
    const bn = 'icon-dropdown-menu';
    const mods = [];

    if (this.props.disabled) {
      toggle = () => { /* do nothing */ };
      mods.push('disabled');
    }

    return (
      <div
        className={osu.classWithModifiers(bn, mods)}
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
    const baseClass = 'simple-menu__item';
    const mods = [];
    const iconClass = 'simple-menu__item-icon';

    if (menuItem.id === this.props.selected) {
      mods.push('active');
    }

    return (
      <button
        className={osu.classWithModifiers(baseClass, mods)}
        key={menuItem.id}
        data-id={menuItem.id}
        onClick={this.select}
      >
        <div className={osu.classWithModifiers(iconClass, ['icon-dropdown-menu'])}>
          {menuItem.icon}
        </div>
        <div className='simple-menu__label'>
          {menuItem.label}
        </div>
      </button>
    );
  }

  select = (event: React.MouseEvent<HTMLElement>) => {
    event.preventDefault();

    const target = event.currentTarget;

    if (!target) {
      return;
    }

    this.props.onSelect(target.dataset.id ?? '');
  }
}
