// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { artistTrackSortFields, artistTrackSortOrders, ArtistTrackSortField, ArtistTrackSortOrder, ArtistTrackSearch } from './search-form';

interface Props {
  params: ArtistTrackSearch;
}

const orderIcon: Record<ArtistTrackSortOrder, string> = {
  asc: 'fas fa-caret-up',
  desc: 'fas fa-caret-down',
};

const defaultOrder: Partial<Record<ArtistTrackSortField, ArtistTrackSortOrder>> = {
  relevance: 'desc',
  update: 'desc',
};

@observer
export default class SortBar extends React.Component<Props> {
  render() {
    return (
      <div className='sort sort--artist-tracks'>
        <div className='sort__items'>
          {artistTrackSortFields.map((field) => this.renderLink(field))}
        </div>
      </div>
    );
  }

  private readonly renderLink = (field: ArtistTrackSortField) => {
    const currentOrder = artistTrackSortOrders.find((o) => `${field}_${o}` === this.props.params.sort);
    let order = currentOrder === null
      ? null
      : artistTrackSortOrders.find((o) => o !== currentOrder);
    order = order ?? defaultOrder[field] ?? artistTrackSortOrders[0];

    const url = `${route('artists.tracks.index')}?${$.param({ ...this.props.params, is_default_sort: false, sort: `${field}_${order}` })}`;

    return (
      <a
        key={field}
        className={classWithModifiers('sort__item', 'button', { active: currentOrder != null })}
        href={url}
      >
        {field}

        <span className='sort__item-arrow'>
          <span className={orderIcon[currentOrder ?? order]} />
        </span>
      </a>
    );
  };
}
