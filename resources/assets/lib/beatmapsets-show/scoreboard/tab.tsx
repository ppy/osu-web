// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import Controller from './controller';
import ScoreboardType from './scoreboard-type';

interface Props {
  controller: Controller;
  type: ScoreboardType;
}

@observer
export default class ScoreboardTab extends React.Component<Props> {
  render() {
    return (
      <div
        className={classWithModifiers('page-tabs__tab', {
          active: this.props.controller.currentType === this.props.type,
        })}
        onClick={this.onClick}
      >
        {trans(`beatmapsets.show.scoreboard.${this.props.type}`)}
      </div>
    );
  }

  private readonly onClick = () => {
    this.props.controller.setCurrent({ type: this.props.type });
  };
}
