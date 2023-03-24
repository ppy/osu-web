// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';

interface Props {
  currentValue: string;
  modifiers?: string[];
  onChange(event: React.MouseEvent<HTMLButtonElement>): void;
  showTitle?: boolean;
  title?: string;
  transPrefix: string;
  values: Readonly<string[]>;
}

export class Sort extends React.PureComponent<Props> {
  static readonly defaultProps = {
    showTitle: true,
    transPrefix: 'sort.',
  };

  render() {
    const items = this.props.values.map((value) => {
      let cssClasses = 'sort__item sort__item--button';
      if (this.props.currentValue === value) {
        cssClasses += ' sort__item--active';
      }

      return (
        <button
          key={value}
          className={cssClasses}
          data-value={value}
          onClick={this.props.onChange}
        >
          {/* FIXME: add icon support */}
          {value === 'rank'
            ? (
              <span>
                <i className={`fas fa-extra-mode-${core.currentUser?.playmode ?? 'osu'}`} /> {trans('sort.rank')}
              </span>
            ) : trans(`${this.props.transPrefix}${value}`)
          }
        </button>
      );
    });

    return (
      <div className={classWithModifiers('sort', this.props.modifiers)}>
        <div className='sort__items'>
          {this.props.showTitle && (
            <span className='sort__item sort__item--title'>{this.props.title ?? trans('sort._')}</span>
          )}
          {items}
        </div>
      </div>
    );
  }
}
