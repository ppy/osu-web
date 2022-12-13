// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetJsonForShow } from 'interfaces/beatmapset-extended-json';
import GenreJson from 'interfaces/genre-json';
import LanguageJson from 'interfaces/language-json';
import { route } from 'laroute';
import { action, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { onError } from 'utils/ajax';
import { parseJson } from 'utils/json';
import { trans } from 'utils/lang';
import { getInt } from 'utils/math';
import Controller from './controller';

interface Props {
  controller: Controller;
  onClose: () => void;
}

let genresCache: GenreJson[];
function genres() {
  return genresCache ??= parseJson('json-genres');
}

let languagesCache: LanguageJson[];
function languages() {
  return languagesCache ??= parseJson('json-languages');
}

@observer
export default class MetadataEditor extends React.Component<Props> {
  @observable private genreId: number;
  @observable private languageId: number;
  @observable private nsfw: boolean;
  @observable private offset: string;
  @observable private xhr: JQuery.jqXHR<BeatmapsetJsonForShow> | null = null;

  private get controller() {
    return this.props.controller;
  }

  private get canEditOffset() {
    return this.controller.beatmapset.current_user_attributes.can_edit_offset;
  }

  constructor(props: Props) {
    super(props);

    const initialState = runInAction(() => ({
      genreId: this.controller.beatmapset.genre.id ?? 0,
      languageId: this.controller.beatmapset.language.id ?? 0,
      nsfw: this.controller.beatmapset.nsfw ?? false,
      offset: this.controller.beatmapset.offset.toString(),
    }));

    this.genreId = initialState.genreId;
    this.languageId = initialState.languageId;
    this.nsfw = initialState.nsfw;
    this.offset = initialState.offset;

    makeObservable(this);
  }

  componentWillUnmount() {
    this.xhr?.abort();
  }

  render() {
    return (
      <form className='simple-form simple-form--modal'>
        <label className='simple-form__row'>
          <div className='simple-form__label'>
            {trans('beatmapsets.show.info.language')}
          </div>

          <div className='form-select form-select--full'>
            <select
              className='form-select__input'
              name='beatmapset[language_id]'
              onChange={this.setLanguageId}
              value={this.languageId}
            >
              {languages().map((language) => (
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
            {trans('beatmapsets.show.info.genre')}
          </div>

          <div className='form-select form-select--full'>
            <select
              className='form-select__input'
              name='beatmapset[genre_id]'
              onChange={this.setGenreId}
              value={this.genreId}
            >
              {genres().map((genre) => (
                genre.id === null ? null :
                  <option key={genre.id} value={genre.id}>
                    {genre.name}
                  </option>
              ))}
            </select>
          </div>
        </label>

        {this.canEditOffset &&
          <label className='simple-form__row'>
            <div className='simple-form__label'>
              {trans('beatmapsets.show.info.offset')}
            </div>

            <input
              className='simple-form__input'
              maxLength={6}
              name='beatmapset[offset]'
              onChange={this.setOffset}
              type='text'
              value={this.offset}
            />
          </label>
        }

        <div className='simple-form__row'>
          <div className='simple-form__label'>
            {trans('beatmapsets.show.info.nsfw')}
          </div>

          <label className='osu-switch-v2'>
            <input
              checked={this.nsfw}
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
                disabled={this.xhr != null}
                onClick={this.save}
                type='button'
              >
                {trans('common.buttons.save')}
              </button>
            </div>

            <div className='simple-form__button'>
              <button
                className='btn-osu-big btn-osu-big--rounded-thin'
                disabled={this.xhr != null}
                onClick={this.props.onClose}
                type='button'
              >
                {trans('common.buttons.cancel')}
              </button>
            </div>
          </div>
        </div>
      </form>
    );
  }

  @action
  private readonly save = () => {
    this.xhr = $.ajax(route('beatmapsets.update', { beatmapset: this.controller.beatmapset.id }), {
      data: { beatmapset: {
        genre_id: this.genreId,
        language_id: this.languageId,
        nsfw: this.nsfw,
        offset: this.canEditOffset ? getInt(this.offset) : undefined,
      } },
      method: 'PATCH',
    });
    this.xhr.fail(onError).always(action(() => {
      this.xhr = null;
    }))
      .done((beatmapset) => runInAction(() => {
        this.controller.state.beatmapset = beatmapset;
        this.props.onClose();
      }));
  };

  @action
  private readonly setGenreId = (e: React.ChangeEvent<HTMLSelectElement>) => {
    this.genreId = parseInt(e.currentTarget.value, 10);
  };

  @action
  private readonly setLanguageId = (e: React.ChangeEvent<HTMLSelectElement>) => {
    this.languageId = parseInt(e.currentTarget.value, 10);
  };

  @action
  private readonly setNsfw = (e: React.ChangeEvent<HTMLInputElement>) => {
    this.nsfw = e.currentTarget.checked;
  };

  @action
  private readonly setOffset = (e: React.ChangeEvent<HTMLInputElement>) => {
    const value = e.currentTarget.value;

    if (/^-?\d*$/.test(value)) {
      this.offset = value;
    }
  };
}
