// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import makeLink from './make-link';
import {
  ArtistTrackSearch,
  artistTrackSearchRelevanceParams,
  ArtistTrackSortField,
  artistTrackSortFields,
  ArtistTrackSortOrder,
  artistTrackSortOrders,
} from './search-form';

interface Props {
  onNewSearch: (url: string) => void;
  params: ArtistTrackSearch;
}

const orderIcon: Record<ArtistTrackSortOrder, Record<'desktop' | 'mobile', string>> = {
  asc: { desktop: 'fas fa-caret-up', mobile: 'fas fa-sort-amount-up' },
  desc: { desktop: 'fas fa-caret-down', mobile: 'fas fa-sort-amount-down' },
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

  get flippedOrder() {
    return this.currentOrder === 'asc' ? 'desc' : 'asc';
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    return (
      <div className='artist-track-search-sort'>
        <div className='artist-track-search-sort__desktop'>
          <div className='sort sort--artist-tracks'>
            <div className='sort__items'>
              <div className='sort__item sort__item--title'>
                {osu.trans('sort._')}
              </div>

              {artistTrackSortFields.map(this.renderLink)}
            </div>
          </div>
        </div>

        <div className='artist-track-search-sort__mobile'>
          <div className='sort-mobile'>
            <div className='sort-mobile__item sort-mobile__item--title'>
              {osu.trans('sort._')}
            </div>
            <div className='sort-mobile__item'>
              <div className='form-select'>
                <select className='form-select__input' onChange={this.handleSortFieldChange} value={this.currentField}>
                  {artistTrackSortFields.map(this.renderOption)}
                </select>
              </div>
            </div>
            <div className='sort-mobile__item'>
              {this.renderOrderButton()}
            </div>
          </div>
        </div>
      </div>
    );
  }

  private readonly handleLinkClick = (e: React.MouseEvent<HTMLAnchorElement>) => {
    e.preventDefault();
    const field = e.currentTarget.dataset.field as ArtistTrackSortField;
    const order = e.currentTarget.dataset.order as ArtistTrackSortOrder;
    this.params.sort = `${field}_${order}`;
    this.props.onNewSearch(e.currentTarget.href);
  };

  private readonly handleSortFieldChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
    const field = e.currentTarget.value as ArtistTrackSortField;

    const newSort: typeof this.params.sort = `${field}_${this.currentOrder}`;

    if (newSort !== this.params.sort) {
      this.params.sort = newSort;
      this.props.onNewSearch(this.makeLink(field, this.currentOrder));
    }
  };

  private isFieldVisible(field: ArtistTrackSortField) {
    if (field === 'relevance') {
      return artistTrackSearchRelevanceParams.some((p) => osu.present(this.params[p]));
    }

    return true;
  }

  private makeLink(field: ArtistTrackSortField, order: ArtistTrackSortOrder) {
    return makeLink({
      ...this.params,
      is_default_sort: false,
      sort: `${field}_${order}`,
    });
  }

  private orderForField(field: ArtistTrackSortField) {
    const ret = this.currentField === field
      ? this.flippedOrder
      : defaultOrder[field] ?? artistTrackSortOrders[0];

    if (ret == null) {
      throw new Error('no alternative sort order');
    }

    return ret;
  }

  private readonly renderLink = (field: ArtistTrackSortField) => {
    if (!this.isFieldVisible(field)) return;

    const order = this.orderForField(field);
    const url = this.makeLink(field, order);
    const orderForIcon = this.currentField === field ? this.currentOrder : order;

    return (
      <a
        key={field}
        className={classWithModifiers('sort__item', 'button', { active: this.currentField === field })}
        data-field={field}
        data-order={order}
        href={url}
        onClick={this.handleLinkClick}
      >
        {osu.trans(`sort.artist_tracks.${field}`)}

        <span className='sort__item-arrow'>
          <span className={orderIcon[orderForIcon].desktop} />
        </span>
      </a>
    );
  };

  private readonly renderOption = (field: ArtistTrackSortField) => {
    if (!this.isFieldVisible(field)) return;

    return (
      <option key={field} value={field}>
        {osu.trans(`sort.artist_tracks.${field}`)}
      </option>
    );
  };

  private renderOrderButton() {
    return (
      <a
        className='sort-mobile__order'
        data-field={this.currentField}
        data-order={this.flippedOrder}
        href={this.makeLink(this.currentField, this.flippedOrder)}
        onClick={this.handleLinkClick}
      >
        <span className={orderIcon[this.currentOrder].mobile} />
      </a>
    );
  }
}
