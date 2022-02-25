// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { PopupMenu } from 'components/popup-menu';
import * as _ from 'lodash';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
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
  declare context: React.ContextType<typeof SlateContext>;

  render(): React.ReactNode {
    return (
      <PopupMenu customRender={this.renderButton} direction='right'>
        {() => (
          <div className='simple-menu simple-menu--popup-menu-compact'>
            {this.props.menuOptions.map(this.renderMenuItem)}
          </div>
        )}
      </PopupMenu>
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
        ref={ref}
        className={classWithModifiers(bn, mods)} // workaround for slatejs 'Cannot resolve a Slate point from DOM point' nonsense
        contentEditable={false}
        onClick={toggle}
      >
        {selected.icon}
        {children}
      </div>
    );
  };

  renderMenuItem = (menuItem: MenuItem) => (
    <button
      key={menuItem.id}
      className={classWithModifiers('simple-menu__item', { active: menuItem.id === this.props.selected })}
      data-id={menuItem.id}
      onClick={this.select}
    >
      <div className={classWithModifiers('simple-menu__item-icon', 'icon-dropdown-menu')}>
        {menuItem.icon}
      </div>
      <div className='simple-menu__label'>
        {menuItem.label}
      </div>
    </button>
  );

  select = (event: React.MouseEvent<HTMLElement>) => {
    event.preventDefault();

    const target = event.currentTarget;

    if (!target) {
      return;
    }

    this.props.onSelect(target.dataset.id ?? '');
  };
}
