// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'big-button';
import { route } from 'laroute';
import { isEqual } from 'lodash';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { jsonClone } from 'utils/json';

type Nullable<T> = T | null | undefined;

type EsRangeField = 'gt' | 'gte' | 'lt' | 'lte';

type EsRange<T> = Partial<Record<EsRangeField, Nullable<T>>>;

export const artistTrackSortFields = [
  'album',
  'artist',
  'bpm',
  'genre',
  'length',
  'relevance',
  'title',
  'update',
] as const;
export type ArtistTrackSortField = typeof artistTrackSortFields[number];

export const artistTrackSortOrders = ['asc', 'desc'] as const;
export type ArtistTrackSortOrder = typeof artistTrackSortOrders[number];

export type ArtistTrackSort = `${ArtistTrackSortField}_${ArtistTrackSortOrder}`;

export const artistTrackSearchRelevanceParams = ['album', 'artist', 'query'] as const;
type ArtistTrackSearchRelevanceParam = typeof artistTrackSearchRelevanceParams[number];

const artistTrackSearchNumberRangeParams = ['bpm', 'length'] as const;
type ArtistTrackSearchNumberRangeParam = typeof artistTrackSearchNumberRangeParams[number];

export type ArtistTrackSearch = {
  genre?: Nullable<string>;
  is_default_sort: boolean;
  sort: ArtistTrackSort;
} & Partial<Record<ArtistTrackSearchRelevanceParam, Nullable<string>>> & Partial<Record<ArtistTrackSearchNumberRangeParam, Nullable<EsRange<number | string>>>>;

interface Props {
  availableGenres: string[];
  initialParams: ArtistTrackSearch;
  onNewSearch: (url: string) => void;
}

@observer
export default class SearchForm extends React.Component<Props> {
  @observable private params = jsonClone(this.props.initialParams);

  @computed
  private get url() {
    return this.makeLink();
  }

  @computed
  private get emptySearch() {
    return {
      is_default_sort: this.params.is_default_sort,
      sort: this.params.sort,
    };
  }

  @computed
  private get isEmptySearch() {
    return isEqual(this.props.initialParams, this.emptySearch);
  }

  @computed
  private get newSearch() {
    // exclude genre from comparison for search button
    return !isEqual({ ...this.params, genre: null }, { ...this.props.initialParams, genre: null });
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    return (
      <form className='artist-track-search-form' onSubmit={this.handleSubmit}>
        <div className='artist-track-search-form__content'>
          <input
            className='artist-track-search-form__big-input'
            name='query'
            onChange={this.handleChangeString}
            placeholder={osu.trans('beatmaps.listing.search.prompt')}
            value={this.params.query ?? ''}
          />

          <h3 className='title title--artist-track-search-advanced'>
            {osu.trans('artist.tracks.index.form.advanced')}
          </h3>

          <div className='artist-track-search-form__advanced'>
            <label className='artist-track-search-form__input-group artist-track-search-form__input-group--2'>
              <div className='artist-track-search-form__label'>
                {osu.trans('artist.tracks.index.form.artist')}
              </div>
              <input
                className='artist-track-search-form__input'
                name='artist'
                onChange={this.handleChangeString}
                value={this.params.artist ?? ''}
              />
            </label>

            <label className='artist-track-search-form__input-group artist-track-search-form__input-group--2'>
              <div className='artist-track-search-form__label'>
                {osu.trans('artist.tracks.index.form.album')}
              </div>
              <input
                className='artist-track-search-form__input'
                name='album'
                onChange={this.handleChangeString}
                value={this.params.album ?? ''}
              />
            </label>

            <label className='artist-track-search-form__input-group'>
              <div className='artist-track-search-form__label'>
                {osu.trans('artist.tracks.index.form.bpm_gte')}
              </div>
              <input
                className='artist-track-search-form__input'
                data-param='bpm'
                data-range='gte'
                onChange={this.handleChangeRangeNatural}
                type='number'
                value={this.params.bpm?.gte ?? ''}
              />
            </label>

            <label className='artist-track-search-form__input-group'>
              <div className='artist-track-search-form__label'>
                {osu.trans('artist.tracks.index.form.bpm_lte')}
              </div>
              <input
                className='artist-track-search-form__input'
                data-param='bpm'
                data-range='lte'
                onChange={this.handleChangeRangeNatural}
                type='number'
                value={this.params.bpm?.lte ?? ''}
              />
            </label>

            <label className='artist-track-search-form__input-group'>
              <div className='artist-track-search-form__label'>
                {osu.trans('artist.tracks.index.form.length_gte')}
              </div>
              <input
                className='artist-track-search-form__input'
                data-param='length'
                data-range='gte'
                onChange={this.handleChangeRangeNatural}
                value={this.params.length?.gte ?? ''}
              />
            </label>

            <label className='artist-track-search-form__input-group'>
              <div className='artist-track-search-form__label'>
                {osu.trans('artist.tracks.index.form.length_lte')}
              </div>
              <input
                className='artist-track-search-form__input'
                data-param='length'
                data-range='lte'
                onChange={this.handleChangeRangeNatural}
                value={this.params.length?.lte ?? ''}
              />
            </label>

            <div className={classWithModifiers('artist-track-search-form__input-group', '4', 'genre')}>
              <div className='artist-track-search-form__label'>
                {osu.trans('artist.tracks.index.form.genre')}
              </div>
              <div className='artist-track-search-form__genres'>
                {this.renderGenreLink(osu.trans('artist.tracks.index.form.genre_all'), null)}
                {this.props.availableGenres.map((genre) => this.renderGenreLink(genre, genre))}
              </div>
            </div>
          </div>
        </div>
        <div className='artist-track-search-form__content artist-track-search-form__content--buttons'>
          <BigButton
            disabled={this.isEmptySearch}
            href={this.makeLink(this.emptySearch)}
            modifiers={['artist-tracks-search', 'rounded-thin']}
            props={{ onClick: this.handleReset }}
            text={osu.trans('common.buttons.reset')}
          />

          <BigButton
            disabled={!this.newSearch}
            href={this.url}
            modifiers={['artist-tracks-search', 'rounded-thin-wide']}
            props={{ onClick: this.handleSubmit }}
            text={osu.trans('common.buttons.search')}
          />
        </div>
      </form>
    );
  }

  @action
  private readonly handleChangeRangeNatural = (e: React.ChangeEvent<HTMLInputElement>) => {
    const input = e.target;

    if (!(input instanceof HTMLInputElement)) {
      throw new Error('incorrect input field type');
    }

    const param = input.dataset.param as ArtistTrackSearchNumberRangeParam;
    const range = input.dataset.range as EsRangeField;

    if (param == null || range == null) {
      throw new Error('missing input field dataset');
    }

    const value = input.value;

    const rangeData = this.params[param] ?? {};
    if (osu.present(value)) {
      rangeData[range] = value;
    } else {
      delete rangeData[range];
    }

    if (Object.keys(rangeData).length === 0) {
      delete this.params[param];
    } else {
      this.params[param] = rangeData;
    }
  };

  @action
  private readonly handleChangeString = (e: React.ChangeEvent<HTMLInputElement>) => {
    const param = e.target.name as ArtistTrackSearchRelevanceParam;
    const value = e.target.value;

    if (osu.present(value)) {
      this.params[param] = value;
    } else {
      delete this.params[param];
    }
  };

  @action
  private readonly handleGenreLinkClick = (e: React.MouseEvent<HTMLAnchorElement>) => {
    e.preventDefault();
    this.params.genre = osu.presence(e.currentTarget.dataset.value);
    this.props.onNewSearch(e.currentTarget.href);
  };

  @action
  private readonly handleReset = (e: React.MouseEvent<HTMLElement>) => {
    if (!(e.currentTarget instanceof HTMLAnchorElement)) return;

    e.preventDefault();
    this.params = this.emptySearch;

    // only navigate if current search isn't an empty search
    if (!this.isEmptySearch) {
      this.props.onNewSearch(this.makeLink(this.emptySearch));
    }
  };

  private readonly handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    this.props.onNewSearch(this.url);
  };

  private makeLink(params: ArtistTrackSearch = this.params) {
    return `${route('artists.tracks.index')}?${$.param(params)}`;
  }

  private renderGenreLink(name: string, value: Nullable<string>) {
    return (
      <a
        key={name}
        className={classWithModifiers('artist-track-search-form__genre-link', {
          active: osu.presence(this.params.genre) === value,
        })}
        data-value={value ?? ''}
        href={this.makeLink({ ...this.params, genre: value })}
        onClick={this.handleGenreLinkClick}
      >
        {name}
      </a>
    );
  }
}
