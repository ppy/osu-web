// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from 'interfaces/game-mode';
import * as React from 'react';
import { trans } from 'utils/lang';
import { navigate } from 'utils/turbolinks';
import { updateQueryString } from 'utils/url';
import { Sort } from './sort';

interface Props {
  current: string | null;
  current_ruleset: GameMode;
  items: string[];
}

export default class RankingVariantFilter extends React.PureComponent<Props> {
  render() {
    return (
      <div className='ranking-filter'>
        <div className='ranking-filter__title'>
          {trans('rankings.filter.variant.title')}
        </div>
        <Sort
          currentValue={this.props.current ?? 'all'}
          onChange={this.onChange}
          showTitle={false}
          transPrefix={`beatmaps.variant.${this.props.current_ruleset}.`}
          values={this.props.items}
        />
      </div>
    );
  }

  private readonly onChange = (event: React.MouseEvent<HTMLButtonElement>) => {
    navigate(updateQueryString(null, { page: null, variant: event.currentTarget.dataset.value }));
  };
}
