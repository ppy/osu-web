// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { artistTrackSearchRelevanceParams, artistTrackSortFields, artistTrackSortOrders, ArtistTrackSortField, ArtistTrackSortOrder, ArtistTrackSearch } from './search-form';

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
  @computed
  get currentField() {
    const ret = artistTrackSortFields.find((f) => `${f}_${this.currentOrder}` === this.props.params.sort);

    if (ret == null) {
      throw new Error('parsed sort parameter is not supported');
    }

    return ret;
  }

  @computed
  get currentOrder() {
    const ret = artistTrackSortOrders.find((o) => (
      artistTrackSortFields.find((f) => `${f}_${o}` === this.props.params.sort) != null
    ));

    if (ret == null) {
      throw new Error('parsed sort parameter is not supported');
    }

    return ret;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    return (
      <>
        <div className='sort sort--artist-tracks'>
          <div className='sort__items'>
            <div className='sort__item sort__item--title'>
              {osu.trans('sort._')}
            </div>

            {artistTrackSortFields.map((field) => this.renderLink(field))}
          </div>
        </div>
      </>
    );
  }

  private readonly handleLinkClick = (e: React.MouseEvent<HTMLAnchorElement>) => {
    e.preventDefault();
    osu.navigate(e.currentTarget.href, true);
  };

  private isFieldVisible(field: ArtistTrackSortField) {
    if (field === 'relevance') {
      return artistTrackSearchRelevanceParams.some((p) => osu.present(this.props.params[p]));
    }

    return true;
  }

  private orderForField(field: ArtistTrackSortField) {
    const ret = this.currentField === field
      ? artistTrackSortOrders.find((o) => o !== this.currentOrder)
      : defaultOrder[field] ?? artistTrackSortOrders[0];

    if (ret == null) {
      throw new Error('no alternative sort order');
    }

    return ret;
  }

  private readonly renderLink = (field: ArtistTrackSortField) => {
    if (!this.isFieldVisible(field)) return;

    const order = this.orderForField(field);
    const url = `${route('artists.tracks.index')}?${$.param({ ...this.props.params, is_default_sort: false, sort: `${field}_${order}` })}`;
    const orderForIcon = this.currentField === field ? order : this.currentOrder;

    return (
      <a
        key={field}
        className={classWithModifiers('sort__item', 'button', { active: this.currentField === field })}
        href={url}
        onClick={this.handleLinkClick}
      >
        {osu.trans(`sort.artist_tracks.${field}`)}

        <span className='sort__item-arrow'>
          <span className={orderIcon[orderForIcon]} />
        </span>
      </a>
    );
  };
}
