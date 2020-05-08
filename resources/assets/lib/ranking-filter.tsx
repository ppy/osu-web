// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { Item, RenderProps, SelectOptions } from 'select-options';
import { Sort } from 'sort';

interface Props {
  countries: Country[];
  sortMode: string;
}

export default class RankingFilter extends React.PureComponent<Props> {
  static defaultProps = {
    sortMode: 'all',
  };

  get options() {
    return [
      { id: 'all', text: 'All' },
      ...this.props.countries.map((country) => {
        return { id: country.code ?? null, text: country.name ?? '' };
      }),
    ];
  }

  handleItemSelected = (item: Item) => {
    console.log(item);
    // stuff
  }

  handleSortSelected = (event: React.MouseEvent) => {
    const target = event.target as HTMLElement;
    osu.navigate(osu.updateQueryString(null, { filter: target.dataset.value }));
  }

  render() {
    return (
      <div className='ranking-filter'>
        <div className='ranking-filter__countries'>
          <SelectOptions
            bn='ranking-select-options'
            renderItem={this.renderItem}
            onItemSelected={this.handleItemSelected}
            options={this.options}
            selected={{ id: 'all', text: 'All' }}
          />
        </div>

        <div className='ranking-filter__sort'>
          <Sort
            onSortSelected={this.handleSortSelected}
            sortMode={this.props.sortMode}
            values={['all', 'friends']}
          />
        </div>
      </div>
    );
  }

  renderItem(item: RenderProps) {
    return (
      <a
        children={item.children}
        className={item.cssClasses}
        href={osu.updateQueryString(null, { country: item.item.id as string })}
        key={item.item.id ?? undefined}
        onClick={item.onClick}
      />
    );
  }
}
