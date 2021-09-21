// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetJson from 'interfaces/beatmapset-json';
import GenreJson from 'interfaces/genre-json';
import LanguageJson from 'interfaces/language-json';
import { route } from 'laroute';
import * as React from 'react';

interface Props {
  beatmapset: BeatmapsetJson;
  onClose: () => void;
}

interface State {
  genreId: number;
  isBusy: boolean;
  languageId: number;
  nsfw: boolean;
  offset: number | string;
}

export default class MetadataEditor extends React.PureComponent<Props, State> {
  private genres = osu.parseJson<GenreJson[]>('json-genres');
  private languages = osu.parseJson<LanguageJson[]>('json-languages');

  constructor(props: Props) {
    super(props);

    this.state = {
      genreId: props.beatmapset.genre.id ?? 0,
      isBusy: false,
      languageId: props.beatmapset.language.id ?? 0,
      nsfw: props.beatmapset.nsfw ?? false,
      offset: props.beatmapset.offset,
    };
  }

  render() {
    return (
      <form className='simple-form simple-form--modal'>
        <label className='simple-form__row'>
          <div className='simple-form__label'>
            {osu.trans('beatmapsets.show.info.language')}
          </div>

          <div className='form-select form-select--full'>
            <select
              className='form-select__input'
              name='beatmapset[language_id]'
              onChange={this.setLanguageId}
              value={this.state.languageId}
            >
              {this.languages.map((language) => (
                language.id === null ? null :
                  <option key={language.id} value={language.id}>
                    {language.name}
                  </option>
              ))}
            </select>
          </div>
        </label>

        <label className='simple-form__row'>
          <div className='simple-form__label'>
            {osu.trans('beatmapsets.show.info.genre')}
          </div>

          <div className='form-select form-select--full'>
            <select
              className='form-select__input'
              name='beatmapset[genre_id]'
              onChange={this.setGenreId}
              value={this.state.genreId}
            >
              {this.genres.map((genre) => (
                genre.id === null ? null :
                  <option key={genre.id} value={genre.id}>
                    {genre.name}
                  </option>
              ))}
            </select>
          </div>
        </label>

        <label className='simple-form__row'>
          <div className='simple-form__label'>
            {osu.trans('beatmapsets.show.info.offset')}
          </div>

          <input
            className='simple-form__input simple-form__input--modal'
            maxLength={6}
            name='beatmapset[offset]'
            onChange={this.setOffset}
            type='text'
            value={this.state.offset}
          />
        </label>

        <div className='simple-form__row'>
          <div className='simple-form__label'>
            {osu.trans('beatmapsets.show.info.nsfw')}
          </div>

          <label className='osu-switch-v2'>
            <input
              checked={this.state.nsfw}
              className='osu-switch-v2__input'
              name='beatmapset[nsfw]'
              onChange={this.setNsfw}
              type='checkbox'
            />
            <span className='osu-switch-v2__content' />
          </label>
        </div>

        <div className='simple-form__row simple-form__row--no-label'>
          <div className='simple-form__buttons'>
            <div className='simple-form__button'>
              <button
                className='btn-osu-big btn-osu-big--rounded-thin'
                disabled={this.state.isBusy}
                onClick={this.save}
                type='button'
              >
                {osu.trans('common.buttons.save')}
              </button>
            </div>

            <div className='simple-form__button'>
              <button
                className='btn-osu-big btn-osu-big--rounded-thin'
                disabled={this.state.isBusy}
                onClick={this.props.onClose}
                type='button'
              >
                {osu.trans('common.buttons.cancel')}
              </button>
            </div>
          </div>
        </div>
      </form>
    );
  }

  private save = () => {
    this.setState({ isBusy: true });

    $.ajax(route('beatmapsets.update', { beatmapset: this.props.beatmapset.id }), {
      data: { beatmapset: {
        genre_id: this.state.genreId,
        language_id: this.state.languageId,
        nsfw: this.state.nsfw,
        offset: isNaN(Number(this.state.offset)) ? undefined : this.state.offset,
      } },
      method: 'PATCH',
    }).done((beatmapset: BeatmapsetJson) => $.publish('beatmapset:set', { beatmapset }))
      .fail(osu.ajaxError)
      .always(() => this.setState({ isBusy: false }))
      .done(this.props.onClose);
  };

  private setGenreId = (e: React.ChangeEvent<HTMLSelectElement>) => {
    this.setState({ genreId: parseInt(e.currentTarget.value, 10) });
  };

  private setLanguageId = (e: React.ChangeEvent<HTMLSelectElement>) => {
    this.setState({ languageId: parseInt(e.currentTarget.value, 10) });
  };

  private setNsfw = (e: React.ChangeEvent<HTMLInputElement>) => {
    this.setState({ nsfw: e.currentTarget.checked });
  };

  private setOffset = (e: React.ChangeEvent<HTMLInputElement>) => {
    const value = e.currentTarget.value;

    if (/^-?\d*$/.test(value)) {
      this.setState({ offset: value });
    }
  }
}
