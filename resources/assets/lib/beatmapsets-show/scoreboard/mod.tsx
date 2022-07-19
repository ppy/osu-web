// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Mod from 'components/mod';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import Controller from './controller';

interface Props {
  controller: Controller;
  mod: string;
}

@observer
export default class ScoreboardMod extends React.Component<Props> {
  render() {
    return (
      <button
        className={classWithModifiers('beatmap-scoreboard-mod', {
          enabled: this.props.controller.enabledMods.has(this.props.mod),
        })}
        onClick={this.onClick}
        type='button'
      >
        <Mod mod={this.props.mod} />
      </button>
    );
  }

  private onClick = () => {
    this.props.controller.setCurrent({ toggleMod: this.props.mod });
  };
}
