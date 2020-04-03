// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
