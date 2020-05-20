// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { Item, RenderProps, SelectOptions } from 'select-options';
import { Sort } from 'sort';

type RankingTypes = 'performance' | 'charts' | 'scores' | 'country';

interface Props {
  countries: Required<Country>[];
  sortMode: string;
  type: RankingTypes;
}

const allCountries = { id: null, text: osu.trans('rankings.countries.all') };

export default class RankingFilter extends React.PureComponent<Props> {
  static defaultProps = {
    sortMode: 'all',
  };

  private options = new Map<string | null, Item<string>>();

  constructor(props: Props) {
    super(props);

    const countries = props.countries.sort((a, b) => {
      const priority = b.display - a.display;

      if (priority !== 0) return priority;

      return a.name.localeCompare(b.name);
    });

    this.options.set(allCountries.id, allCountries);
    countries.forEach((country) => {
      this.options.set(country.code, { id: country.code, text: country.name });
    });
  }

  get country() {
    return new URL(window.location.href).searchParams.get('country');
  }

  get selectedOption() {
    return this.options.get(this.country) ?? allCountries;
  }

  handleItemSelected = (item: Item) => {
    osu.navigate(osu.updateQueryString(null, { country: item.id }));
  }

  handleSortSelected = (event: React.MouseEvent<HTMLButtonElement>) => {
    osu.navigate(osu.updateQueryString(null, { filter: event.currentTarget.dataset.value }));
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
        renderItem={this.renderOption}
        onItemSelected={this.handleItemSelected}
        options={[...this.options.values()]} // TODO: change to iterable
        selected={this.selectedOption}
      />
    );
  }

  renderOption(option: RenderProps) {
    return (
      <a
        children={option.children}
        className={option.cssClasses}
        href={osu.updateQueryString(null, { country: option.item.id })}
        key={option.item.id ?? ''}
        onClick={option.onClick}
      />
    );
  }
}
