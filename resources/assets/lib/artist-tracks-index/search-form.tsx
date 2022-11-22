// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import InputContainer from 'components/input-container';
import { isEqual } from 'lodash';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { jsonClone } from 'utils/json';
import { trans } from 'utils/lang';
import { presence, present } from 'utils/string';
import makeLink from './make-link';

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

const lengthRegexp = '^\\d+(\\.\\d*)?(ms|s|m|h)?$';

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
    return isEqual(this.params, this.emptySearch);
  }

  @computed
  private get newSearch() {
    return !isEqual(this.params, this.props.initialParams);
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    return (
      <form className='artist-track-search-form' onSubmit={this.handleSubmit}>
        <input className='u-invisible' type='submit' />
        <div className='artist-track-search-form__content'>
          <input
            className='artist-track-search-form__big-input'
            name='query'
            onChange={this.handleChangeString}
            placeholder={trans('beatmaps.listing.search.prompt')}
            value={this.params.query ?? ''}
          />

          <h3 className='title title--artist-track-search-advanced'>
            {trans('artist.tracks.index.form.advanced')}
          </h3>

          <div className='artist-track-search-form__advanced'>
            <InputContainer labelKey='artist.tracks.index.form.artist' modifiers='2'>
              <input
                className='artist-track-search-form__input'
                name='artist'
                onChange={this.handleChangeString}
                value={this.params.artist ?? ''}
              />
            </InputContainer>
            <InputContainer labelKey='artist.tracks.index.form.album' modifiers='2'>
              <input
                className='artist-track-search-form__input'
                name='album'
                onChange={this.handleChangeString}
                value={this.params.album ?? ''}
              />
            </InputContainer>

            <InputContainer labelKey='artist.tracks.index.form.bpm_gte'>
              <input
                className='artist-track-search-form__input'
                data-param='bpm'
                data-range='gte'
                onChange={this.handleChangeRangeNatural}
                type='number'
                value={this.params.bpm?.gte ?? ''}
              />
            </InputContainer>

            <InputContainer labelKey='artist.tracks.index.form.bpm_lte'>
              <input
                className='artist-track-search-form__input'
                data-param='bpm'
                data-range='lte'
                onChange={this.handleChangeRangeNatural}
                type='number'
                value={this.params.bpm?.lte ?? ''}
              />
            </InputContainer>

            <InputContainer labelKey='artist.tracks.index.form.length_gte'>
              <input
                className='artist-track-search-form__input'
                data-param='length'
                data-range='gte'
                onChange={this.handleChangeRangeNatural}
                pattern={lengthRegexp}
                value={this.params.length?.gte ?? ''}
              />
            </InputContainer>

            <InputContainer labelKey='artist.tracks.index.form.length_lte'>
              <input
                className='artist-track-search-form__input'
                data-param='length'
                data-range='lte'
                onChange={this.handleChangeRangeNatural}
                pattern={lengthRegexp}
                value={this.params.length?.lte ?? ''}
              />
            </InputContainer>

            <InputContainer labelKey='artist.tracks.index.form.genre' modifiers={['4', 'genre']}>
              <div className='artist-track-search-form__genres'>
                {this.renderGenreLink(trans('artist.tracks.index.form.genre_all'), null)}
                {this.props.availableGenres.map((genre) => this.renderGenreLink(genre, genre))}
              </div>
            </InputContainer>
          </div>
        </div>
        <div className='artist-track-search-form__content artist-track-search-form__content--buttons'>
          <BigButton
            disabled={this.isEmptySearch}
            href={this.makeLink(this.emptySearch)}
            modifiers={['artist-track-search', 'rounded-thin']}
            props={{ onClick: this.handleReset }}
            text={trans('common.buttons.reset')}
          />

          <BigButton
            disabled={!this.newSearch}
            href={this.url}
            modifiers={['artist-track-search', 'rounded-thin-wide']}
            props={{ onClick: this.handleSubmit }}
            text={trans('common.buttons.search')}
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

    const value = presence(input.value);

    if (value != null && input.pattern != null && (RegExp(input.pattern).exec(value)) == null) {
      return;
    }

    const rangeData = this.params[param] ?? {};
    if (value != null) {
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

    if (present(value)) {
      this.params[param] = value;
    } else {
      delete this.params[param];
    }
  };

  @action
  private readonly handleGenreLinkClick = (e: React.MouseEvent<HTMLAnchorElement>) => {
    e.preventDefault();
    this.params.genre = presence(e.currentTarget.dataset.value);
    this.props.onNewSearch(e.currentTarget.href);
  };

  @action
  private readonly handleReset = (e: React.MouseEvent<HTMLElement>) => {
    const target = e.currentTarget;

    if (!(target instanceof HTMLAnchorElement)) return;

    e.preventDefault();
    this.params = this.emptySearch;

    // only navigate if current search isn't already an empty search
    if (this.newSearch) {
      this.props.onNewSearch(target.href);
    }
  };

  private readonly handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();

    // only navigate if current search isn't the same as the new search
    if (this.newSearch) {
      this.props.onNewSearch(this.url);
    }
  };

  private makeLink(params: ArtistTrackSearch = this.params) {
    return makeLink(params);
  }

  private renderGenreLink(name: string, value: Nullable<string>) {
    return (
      <a
        key={name}
        className={classWithModifiers('artist-track-search-form__genre-link', {
          active: presence(this.params.genre) === value,
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
