// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import CountryJson from 'interfaces/country-json';
import GameMode from 'interfaces/game-mode';
import core from 'osu-core-singleton';
import * as React from 'react';
import { Option, OptionRenderProps, SelectOptions } from 'select-options';
import { Sort } from 'sort';
import { currentUrlParams } from 'utils/turbolinks';
import { updateQueryString } from 'utils/url';

type RankingTypes = 'performance' | 'charts' | 'scores' | 'country';

interface Props {
  countries?: Required<CountryJson>[];
  gameMode: GameMode;
  type: RankingTypes;
  variants?: string[];
}

const allCountries = { id: null, text: osu.trans('rankings.countries.all') };

export default class RankingFilter extends React.PureComponent<Props> {
  private countriesSorted?: Required<CountryJson>[];
  private optionsCached?: Map<string | null, Option<string>>;
  private prevCountries?: Required<CountryJson>[];

  get countries() {
    if (this.props.countries == null) return [];

    if (this.countriesSorted == null) {
      this.countriesSorted = this.props.countries.sort((a, b) => {
        // prioritizes current user's country
        if (core.currentUser?.country_code === a.code) return -1;
        if (core.currentUser?.country_code === b.code) return 1;

        const priority = b.display - a.display;

        if (priority !== 0) return priority;

        return a.name.localeCompare(b.name);
      });
    }

    return this.countriesSorted;
  }

  get countryCode() {
    return currentUrlParams().get('country');
  }

  get currentVariant() {
    return currentUrlParams().get('variant');
  }

  get filterMode() {
    return currentUrlParams().get('filter');
  }

  get options() {
    if (this.optionsCached == null) {
      // local assignment workaround for https://github.com/microsoft/TypeScript/issues/36436
      const optionsCached = this.optionsCached = new Map<string | null, Option<string>>();

      optionsCached.set(allCountries.id, allCountries);
      this.countries.forEach((country) => {
        optionsCached.set(country.code, { id: country.code, text: country.name });
      });
    }

    return this.optionsCached;
  }

  get selectedOption() {
    return this.options.get(this.countryCode) ?? allCountries;
  }

  // TODO: rename component prop to onChange
  handleCountryChange = (option: Option) => {
    osu.navigate(updateQueryString(null, { country: option.id, page: null }));
  };

  handleFilterChange = (event: React.MouseEvent<HTMLButtonElement>) => {
    osu.navigate(updateQueryString(null, { filter: event.currentTarget.dataset.value, page: null }));
  };

  handleRenderOption = (props: OptionRenderProps) => (
    <a
      key={props.option.id ?? ''}
      className={props.cssClasses}
      href={updateQueryString(null, { country: props.option.id, page: null })}
      onClick={props.onClick}
    >
      {props.children}
    </a>
  );

  handleVariantChange = (event: React.MouseEvent<HTMLButtonElement>) => {
    osu.navigate(updateQueryString(null, { page: null, variant: event.currentTarget.dataset.value }));
  };

  render() {
    // TODO: consider using memoize-one?
    if (this.prevCountries !== this.props.countries) {
      this.countriesSorted = undefined;
      this.optionsCached = undefined;
      this.prevCountries = this.props.countries;
    }

    return (
      <div className='ranking-filter'>
        <div className='ranking-filter__item ranking-filter__item--full'>
          {this.renderCountries()}
        </div>

        {core.currentUser != null && (
          <div className='ranking-filter__item'>
            <div className='ranking-filter__item--title'>
              {osu.trans('rankings.filter.title')}
            </div>
            <Sort
              currentValue={this.filterMode ?? 'all'}
              onChange={this.handleFilterChange}
              showTitle={false}
              values={['all', 'friends']}
            />
          </div>
        )}

        {this.props.variants != null && (
          <div className='ranking-filter__item'>
            <div className='ranking-filter__item--title'>
              {osu.trans('rankings.filter.variant.title')}
            </div>
            {this.renderVariants()}
          </div>
        )}
      </div>
    );
  }

  renderCountries() {
    if (this.props.type !== 'performance') return null;

    return (
      <>
        <div className='ranking-filter__item--title'>
          {osu.trans('rankings.countries.title')}
        </div>
        <SelectOptions
          bn='ranking-select-options'
          onChange={this.handleCountryChange}
          options={[...this.options.values()]} // TODO: change to iterable
          renderOption={this.handleRenderOption}
          selected={this.selectedOption}
        />
      </>
    );
  }

  renderVariants() {
    if (this.props.variants == null) return null;

    return (
      <Sort
        currentValue={this.currentVariant ?? 'all'}
        onChange={this.handleVariantChange}
        showTitle={false}
        transPrefix={`beatmaps.variant.${this.props.gameMode}.`}
        values={this.props.variants}
      />
    );
  }
}
