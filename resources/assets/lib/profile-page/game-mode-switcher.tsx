// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import PlaymodeTabs from 'components/playmode-tabs';
import StringWithComponent from 'components/string-with-component';
import { gameModes } from 'interfaces/game-mode';
import { route } from 'laroute';
import { action, observable, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { onErrorWithCallback } from 'utils/ajax';
import { trans } from 'utils/lang';
import Controller from './controller';

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
      <>
        {this.renderSetDefault()}
        <PlaymodeTabs
          currentMode={this.props.controller.currentMode}
          defaultMode={this.props.controller.state.user.playmode}
          entries={gameModes.map((mode) => ({
            disabled: false,
            href: route('users.show', { mode, user: this.props.controller.state.user.id }),
            mode,
          }))}
        />
      </>
    );
  }

  private renderSetDefault() {
    if (!this.props.controller.withEdit || this.props.controller.state.user.playmode === this.props.controller.currentMode) {
      return null;
    }

    return (
      <div className='profile-page-button'>
        <button
          className='profile-page-button__button'
          disabled={this.settingDefault}
          onClick={this.setDefault}
          type='button'
        >
          <StringWithComponent
            mappings={{
              mode: <strong>{trans(`beatmaps.mode.${this.props.controller.currentMode}`)}</strong>,
            }}
            pattern={trans('users.show.edit.default_playmode.set')}
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
