// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { Item, RenderProps, SelectOptions } from 'select-options';
import { Sort } from 'sort';

interface Props {
  countries: Country[];
  sortMode: string;
}

interface State {
  country: string | null;
}

const allCountries = { id: null, text: 'All' };

export default class RankingFilter extends React.PureComponent<Props, State> {
  static defaultProps = {
    sortMode: 'all',
  };

  readonly state: State = {
    country: new URL(window.location.href).searchParams.get('country'),
  };

  get options() {
    return [
      allCountries,
      ...this.props.countries.map((country) => {
        return { id: country.code ?? null, text: country.name ?? '' };
      }),
    ];
  }

  get selectedCountry() {
    return this.options.find((x) => x.id === this.state.country) ?? allCountries;
  }

  handleItemSelected = (item: Item) => {
    osu.navigate(osu.updateQueryString(null, { country: item.id as string | null }));
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
            selected={this.selectedCountry}
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
        key={item.item.id ?? ''}
        onClick={item.onClick}
      />
    );
  }
}
