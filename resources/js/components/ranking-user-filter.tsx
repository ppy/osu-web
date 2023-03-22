// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { trans } from 'utils/lang';
import { navigate } from 'utils/turbolinks';
import { updateQueryString } from 'utils/url';
import { Sort } from './sort';

const filters = ['all', 'friends'] as const;

interface Props {
  current: (typeof filters[number]) |  null;
}

export default class RankingUserFilter extends React.PureComponent<Props> {
  render() {
    return (
      <div className='ranking-filter'>
        <div className='ranking-filter__title'>
          {trans('rankings.filter.title')}
        </div>
        <Sort
          currentValue={this.props.current ?? 'all'}
          onChange={this.onChange}
          showTitle={false}
          values={filters}
        />
      </div>
    );
  }

  private readonly onChange = (event: React.MouseEvent<HTMLButtonElement>) => {
    navigate(updateQueryString(null, { filter: event.currentTarget.dataset.value, page: null }));
  };
}
