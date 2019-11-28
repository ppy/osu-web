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

import * as React from 'react';

interface Props {
  modifiers?: string[];
  sortMode: string;
  values: string[];
  onSortSelected(event: React.MouseEvent): void;
}

export class Sort extends React.PureComponent<Props> {
  render() {
    const items = this.props.values.map((value) => {
      let cssClasses = 'sort__item sort__item--button';
      if (this.props.sortMode === value) {
        cssClasses += ' sort__item--active';
      }

      return (
        <button
          className={cssClasses}
          data-value={value}
          key={value}
          onClick={this.props.onSortSelected}
        >
          {value === 'rank'
            ? <span>
                <i className={`fas fa-extra-mode-${currentUser.playmode ?? 'osu'}`} /> {osu.trans('sort.rank')}
              </span>
            : osu.trans(`sort.${value}`)
          }
        </button>
      );
    });

    return (
      <div className={osu.classWithModifiers('sort', this.props.modifiers)}>
        <div className='sort__items'>
          <span className='sort__item sort__item--title'>{osu.trans('sort._')}</span>
          {items}
        </div>
      </div>
    );
  }
}
