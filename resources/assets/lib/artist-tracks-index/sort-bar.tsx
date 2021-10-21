// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import {
  ArtistTrackSearch,
  artistTrackSearchRelevanceParams,
  ArtistTrackSort,
  ArtistTrackSortField,
  artistTrackSortFields,
  ArtistTrackSortOrder,
  artistTrackSortOrders,
} from './search-form';

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
  @observable params = this.props.params;

  @computed
  get currentField() {
    const ret = artistTrackSortFields.find((f) => `${f}_${this.currentOrder}` === this.params.sort);

    if (ret == null) {
      throw new Error(`sort parameter is not supported (${this.params.sort})`);
    }

    return ret;
  }

  @computed
  get currentOrder() {
    const ret = artistTrackSortOrders.find((o) => (
      artistTrackSortFields.find((f) => `${f}_${o}` === this.params.sort) != null
    ));

    if (ret == null) {
      throw new Error(`sort parameter is not supported (${this.params.sort})`);
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
    const sort = e.currentTarget.dataset.value as ArtistTrackSort;
    this.params.sort = sort;
    osu.navigate(e.currentTarget.href, true);
  };

  private isFieldVisible(field: ArtistTrackSortField) {
    if (field === 'relevance') {
      return artistTrackSearchRelevanceParams.some((p) => osu.present(this.params[p]));
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
    const sort = `${field}_${order}`;
    const url = `${route('artists.tracks.index')}?${$.param({ ...this.params, is_default_sort: false, sort })}`;
    const orderForIcon = this.currentField === field ? this.currentOrder : order;

    return (
      <a
        key={field}
        className={classWithModifiers('sort__item', 'button', { active: this.currentField === field })}
        data-value={sort}
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
