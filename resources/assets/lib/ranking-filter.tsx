// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { Item, RenderProps, SelectOptions } from 'select-options';
import { Sort } from 'sort';

type RankingTypes = 'performance' | 'charts' | 'scores' | 'country';

interface Props {
  countries: Country[];
  sortMode: string;
  type: RankingTypes;
}

interface State {
  country: string | null;
}

const allCountries = { id: null, text: osu.trans('rankings.countries.all') };

export default class RankingFilter extends React.PureComponent<Props, State> {
  static defaultProps = {
    sortMode: 'all',
  };

  readonly state: State = {
    country: new URL(window.location.href).searchParams.get('country'),
  };

  private options: Array<Item<string>>;

  constructor(props: Props) {
    super(props);

    const countries = props.countries.sort((a, b) => {
      return a.name.localeCompare(b.name);
    });

    this.options = [
      allCountries,
      ...countries.map((country) => {
        return { id: country.code, text: country.name };
      }),
    ];
  }

  get selectedCountry() {
    return this.options.find((x) => x.id === this.state.country) ?? allCountries;
  }

  handleItemSelected = (item: Item) => {
    osu.navigate(osu.updateQueryString(null, { country: item.id }));
  }

  handleSortSelected = (event: React.MouseEvent) => {
    const target = event.target as HTMLElement;
    osu.navigate(osu.updateQueryString(null, { filter: target.dataset.value }));
  }

  render() {
    return (
      <div className='ranking-filter'>
        <div className='ranking-filter__countries'>
          {this.renderCountries()}
        </div>

        <div className='ranking-filter__sort'>
          <Sort
            onSortSelected={this.handleSortSelected}
            sortMode={this.props.sortMode}
            title={osu.trans('rankings.filter.title')}
            values={['all', 'friends']}
          />
        </div>
      </div>
    );
  }

  renderCountries() {
    if (this.props.type !== 'performance') return null;

    return (
      <SelectOptions
        bn='ranking-select-options'
        renderItem={this.renderItem}
        onItemSelected={this.handleItemSelected}
        options={this.options}
        selected={this.selectedCountry}
      />
    );
  }

  renderItem(item: RenderProps) {
    return (
      <a
        children={item.children}
        className={item.cssClasses}
        href={osu.updateQueryString(null, { country: item.item.id })}
        key={item.item.id ?? ''}
        onClick={item.onClick}
      />
    );
  }
}
