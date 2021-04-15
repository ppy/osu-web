// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Mod from 'mod';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  enabled: boolean;
  mod: string;
}

export default class ScoreboardMod extends React.PureComponent<Props> {
  render() {
    return (
      <button
        className={classWithModifiers('beatmap-scoreboard-mod', { enabled: this.props.enabled })}
        onClick={this.onClick}
        type='button'
      >
        <Mod mod={this.props.mod} />
      </button>
    );
  }

  private onClick = () => {
    $.publish('beatmapset:scoreboard:set', { enabledMod: this.props.mod });
  };
}
