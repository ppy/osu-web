// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import SelectOptions, { Option, OptionRenderProps } from 'components/select-options';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { trans } from 'utils/lang';
import { navigate } from 'utils/turbolinks';
import { updateQueryString } from 'utils/url';

interface CountryOption extends Option {
  id: string | null;
}

interface Props {
  current?: CountryOption;
  items: CountryOption[];
}

const allCountries = { id: null, text: trans('rankings.countries.all') };

@observer
export default class RankingFilter extends React.Component<Props> {
  @computed
  private get items() {
    return [allCountries, ...this.props.items.sort((a, b) => {
      // prioritizes current user's country
      if (core.currentUser?.country_code === a.id) return -1;
      if (core.currentUser?.country_code === b.id) return 1;

      return a.text.localeCompare(b.text);
    })];
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    return (
      <div className='ranking-filter ranking-filter--full'>
        <div className='ranking-filter__title'>
          {trans('rankings.countries.title')}
        </div>
        <SelectOptions
          modifiers='ranking'
          onChange={this.onChange}
          options={this.items}
          renderOption={this.handleRenderOption}
          selected={this.props.current ?? allCountries}
        />
      </div>
    );
  }

  private readonly handleRenderOption = (props: OptionRenderProps<CountryOption>) => (
    <a
      key={props.option.id}
      className={props.cssClasses}
      href={updateQueryString(null, { country: props.option.id, page: null })}
      onClick={props.onClick}
    >
      {props.children}
    </a>
  );

  private readonly onChange = (option: CountryOption) => {
    navigate(updateQueryString(null, { country: option.id, page: null }));
  };
}

