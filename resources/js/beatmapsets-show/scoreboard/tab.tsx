// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
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
  private get isVisible() {
    return this.props.type !== 'team' || core.currentUser?.team != null;
  }

  render() {
    if (!this.isVisible) return null;

    const label = trans(`beatmapsets.show.scoreboard.${this.props.type}`);

    return (
      <div
        className={classWithModifiers('page-tabs__tab', {
          active: this.props.controller.currentType === this.props.type,
        })}
        onClick={this.onClick}
      >
        <span className='fake-bold' data-content={label}>
          {label}
        </span>
      </div>
    );
  }

  private readonly onClick = () => {
    this.props.controller.setCurrent({ type: this.props.type });
  };
}
