// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import CurrentUserJson from 'interfaces/current-user-json';
import GameMode, { gameModes } from 'interfaces/game-mode';
import { route } from 'laroute';
import { action, observable, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import StringWithComponent from 'string-with-component';
import { onErrorWithCallback } from 'utils/ajax';
import { classWithModifiers } from 'utils/css';

const bn = 'game-mode';

interface Props {
  currentMode: GameMode;
  user: CurrentUserJson;
  withEdit: boolean;
}

@observer
export default class GameModeSwitcher extends React.Component<Props> {
  @observable private settingDefault = false;
  private xhr?: JQuery.jqXHR<CurrentUserJson>;

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentWillUnmount() {
    this.xhr?.abort();
  }

  render() {
    if (this.props.user.is_bot) {
      return null;
    }

    return (
      <div className={bn}>
        {this.renderSetDefault()}
        <ul className={`${bn}__items`}>
          {gameModes.map((mode) => (
            <li key={mode} className={`${bn}__item`}>
              <a
                className={classWithModifiers('game-mode-link', { active: mode === this.props.currentMode })}
                href={route('users.show', { mode, user: this.props.user.id })}
              >
                {osu.trans(`beatmaps.mode.${mode}`)}
                {this.props.user.playmode === mode &&
                  <span
                    className='game-mode-link__icon'
                    title={osu.trans('users.show.edit.default_playmode.is_default_tooltip')}
                  >
                    {' '}
                    <span className='fas fa-star' />
                  </span>
                }
              </a>
            </li>
          ))}
        </ul>
      </div>
    );
  }

  private renderSetDefault() {
    if (!this.props.withEdit || this.props.user.playmode === this.props.currentMode) {
      return null;
    }

    return (
      <div className={`${bn}__set-default hidden-xs`}>
        <button
          className='profile-page-button'
          disabled={this.settingDefault}
          onClick={this.setDefault}
          type='button'
        >
          <StringWithComponent
            mappings={{
              mode: <strong>{osu.trans(`beatmaps.mode.${this.props.currentMode}`)}</strong>,
            }}
            pattern={osu.trans('users.show.edit.default_playmode.set')}
          />
        </button>
      </div>
    );
  }

  private readonly setDefault = () => {
    this.settingDefault = true;

    this.xhr =
      $.ajax(route('account.options'), {
        data: {
          user: {
            playmode: this.props.currentMode,
          },
        },
        method: 'PUT',
      }).always(action(() => {
        this.settingDefault = false;
      })).done((data) => {
        $.publish('user:update', data);
      }).fail(onErrorWithCallback(this.setDefault));
  };
}
