// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import PopupMenu from 'components/popup-menu';
import PopupMenuState from 'components/popup-menu-state';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { SlateContext } from './slate-context';

export interface MenuItem {
  icon: React.ReactNode;
  id: string;
  label: React.ReactNode;
  renderIcon?: boolean;
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

  private readonly popupMenuState = new PopupMenuState();

  render() {
    const selected: MenuItem = this.props.menuOptions.find((option) => option.id === this.props.selected) ?? this.props.menuOptions[0];

    return (
      <div
        ref={this.popupMenuState.setButtonRef}
        className={classWithModifiers('icon-dropdown-menu', { disabled: this.props.disabled })}
        // workaround for slatejs 'Cannot resolve a Slate point from DOM point' nonsense
        contentEditable={false}
        onClick={this.toggle}
      >
        {selected.icon}

        <PopupMenu direction='right' skipButton state={this.popupMenuState}>
          {() => (
            <div className='simple-menu simple-menu--popup-menu-compact'>
              {this.props.menuOptions.map(this.renderMenuItem)}
            </div>
          )}
        </PopupMenu>
      </div>
    );
  }

  renderMenuItem = (menuItem: MenuItem) => (
    <button
      key={menuItem.id}
      className={classWithModifiers('simple-menu__item', { active: menuItem.id === this.props.selected })}
      data-id={menuItem.id}
      onClick={this.select}
    >
      {(menuItem.renderIcon ?? true)
        ? (
          <>
            <div className={classWithModifiers('simple-menu__item-icon', 'icon-dropdown-menu')}>
              {menuItem.icon}
            </div>
            <div className='simple-menu__label'>
              {menuItem.label}
            </div>
          </>
        ) : menuItem.label}
    </button>
  );

  select = (event: React.MouseEvent<HTMLElement>) => {
    event.preventDefault();

    const target = event.currentTarget;

    if (target == null) {
      return;
    }

    this.props.onSelect(target.dataset.id ?? '');
  };

  private readonly toggle = () => {
    if (!this.props.disabled) {
      this.popupMenuState.toggle();
    }
  };
}
