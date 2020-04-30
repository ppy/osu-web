// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { Sort } from 'sort';

interface Props {
  sortMode: string;
}

export default class RankingFilter extends React.PureComponent<Props> {
  static defaultProps = {
    sortMode: 'all',
  };

  handleOnSortSelected = (event: React.MouseEvent) => {
    const target = event.target as HTMLElement;
    osu.navigate(osu.updateQueryString(null, { filter: target.dataset.value }));
  }

  render() {
    return (
      <Sort
        onSortSelected={this.handleOnSortSelected}
        sortMode={this.props.sortMode}
        values={['all', 'friends']}
      />
    );
  }
}
