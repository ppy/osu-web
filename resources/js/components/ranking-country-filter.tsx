// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import SelectOptions from 'components/select-options';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { trans } from 'utils/lang';
import { updateQueryString } from 'utils/url';

interface CountryOption {
  id: string | null;
  text: string;
}

interface Props {
  currentItem: CountryOption | null;
  items: CountryOption[];
}

const allCountries = { id: null, text: trans('rankings.countries.all') };

@observer
export default class RankingFilter extends React.Component<Props> {
  @computed
  private get items() {
    const ordered = [allCountries, ...this.props.items.sort((a, b) => {
      // prioritizes current user's country
      if (core.currentUser?.country_code === a.id) return -1;
      if (core.currentUser?.country_code === b.id) return 1;

      return a.text.localeCompare(b.text);
    })];

    return ordered.map((option) => ({
      children: option.text,
      href: this.href(option.id),
      id: option.id,
    }));
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    const currentItem = this.props.currentItem ?? allCountries;

    return (
      <div className='ranking-filter ranking-filter--full'>
        <div className='ranking-filter__title'>
          {trans('rankings.countries.title')}
        </div>
        <SelectOptions
          href={this.href(currentItem.id)}
          modifiers='ranking'
          options={this.items}
          selected={currentItem.id}
        >
          {currentItem.text}
        </SelectOptions>
      </div>
    );
  }

  private href(id?: string | null) {
    return updateQueryString(null, { country: id, page: null });
  }
}
