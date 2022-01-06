// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { gameModes } from 'interfaces/game-mode';
import { route } from 'laroute';
import { action, observable, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import StringWithComponent from 'string-with-component';
import { onErrorWithCallback } from 'utils/ajax';
import { classWithModifiers } from 'utils/css';
import Controller from './controller';

const bn = 'game-mode';

interface Props {
  controller: Controller;
}

@observer
export default class GameModeSwitcher extends React.Component<Props> {
  @observable private settingDefault = false;

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    if (this.props.controller.state.user.is_bot) {
      return null;
    }

    return (
      <div className={bn}>
        {this.renderSetDefault()}
        <ul className={`${bn}__items`}>
          {gameModes.map((mode) => (
            <li key={mode} className={`${bn}__item`}>
              <a
                className={classWithModifiers('game-mode-link', { active: mode === this.props.controller.currentMode })}
                href={route('users.show', { mode, user: this.props.controller.state.user.id })}
              >
                {osu.trans(`beatmaps.mode.${mode}`)}
                {this.props.controller.state.user.playmode === mode &&
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
    if (!this.props.controller.withEdit || this.props.controller.state.user.playmode === this.props.controller.currentMode) {
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
              mode: <strong>{osu.trans(`beatmaps.mode.${this.props.controller.currentMode}`)}</strong>,
            }}
            pattern={osu.trans('users.show.edit.default_playmode.set')}
          />
        </button>
      </div>
    );
  }

  @action
  private readonly setDefault = () => {
    this.settingDefault = true;

    this.props.controller.apiSetDefaultGameMode()
      .always(action(() => {
        this.settingDefault = false;
      })).fail(onErrorWithCallback(this.setDefault));
  };
}
