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

import { BeatmapIcon } from 'beatmap-icon';
import * as _ from 'lodash';
import * as React from 'react';
import { Transforms } from 'slate';
import { ReactEditor } from 'slate-react';
import { PopupMenuPersistent } from '../popup-menu-persistent';
import { SlateContext } from './slate-context';

interface MenuItem {
  icon: JSX.Element;
  id: string | number;
  label: string;
}

export default class EditorBeatmapSelector extends React.Component<any, any> {
  static contextType = SlateContext;
  menuOptions: MenuItem[] = [];

  render(): React.ReactNode {
    this.menuOptions = [];
    this.menuOptions.push({
      icon: <i className='fas fa-fw fa-star-of-life' style={{width: '22px', alignSelf: 'center', lineHeight: 'inherit'}} />,
      id: 'all',
      label: osu.trans('beatmaps.discussions.mode.scopes.generalAll'),
    });

    this.props.beatmaps.forEach((beatmap: Beatmap) => {
      if (beatmap.deleted_at) {
        return;
      }

      this.menuOptions.push({
        icon: <BeatmapIcon beatmap={beatmap} showTitle={false} />,
        id: beatmap.id,
        label: beatmap.version,
      });
    });

    return (
      <PopupMenuPersistent customRender={this.renderButton}>
        {() => {
          return (
            <div className='simple-menu simple-menu--popup-menu-compact'>
              {this.menuOptions.map((item) => this.renderItem(item))}
            </div>
            );
        }}
      </PopupMenuPersistent>
    );
  }

  renderButton = (children: JSX.Element[], ref: React.RefObject<HTMLDivElement>, toggle: (event: React.MouseEvent<HTMLElement>) => void) => {
    const selected: MenuItem = _.find(this.menuOptions, (option) => option.id === this.props.element.beatmapId) || this.menuOptions[0];
    return (
      <div ref={ref} className='beatmap-discussion-newer__dropdown' onClick={toggle} contentEditable={false} style={{userSelect: 'none'}}>
        {selected.icon}
        {children}
      </div>
    );
  }

  renderItem = (menuItem: MenuItem) => {
    let menuItemClasses = 'simple-menu__item';
    if (this.props.element.beatmapId === menuItem.id) {
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
        <div
          style={{
            paddingLeft: '5px',
          }}
        >
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

    const id = target.dataset.id !== 'all' ? parseInt(target.dataset.id || '', 10) : 'all';
    if (id) {
      const path = ReactEditor.findPath(this.context, this.props.element);
      Transforms.setNodes(this.context, {beatmapId: id}, {at: path});
    }
  }
}
