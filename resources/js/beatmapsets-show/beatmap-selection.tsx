// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapIcon } from 'components/beatmap-icon';
import { action, computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { generate as generateHash } from 'utils/beatmapset-page-hash';
import { classWithModifiers } from 'utils/css';
import Controller from './controller';

interface Props {
  beatmap: Controller['currentBeatmap'];
  controller: Controller;
}

@observer
export default class BeatmapSelection extends React.Component<Props> {
  @computed
  get active() {
    return this.props.controller.currentBeatmap.id === this.props.beatmap.id;
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  render() {
    const className = classWithModifiers('beatmapset-beatmap-picker__beatmap', { active: this.active });

    return (
      <a
        className={className}
        href={generateHash({ beatmap: this.props.beatmap })}
        onClick={this.onClick}
        onMouseEnter={this.onMouseEnter}
        onMouseLeave={this.onMouseLeave}
      >
        <BeatmapIcon beatmap={this.props.beatmap} modifiers='beatmapset' />
      </a>
    );
  }

  private onClick = (e: React.SyntheticEvent) => {
    e.preventDefault();

    this.props.controller.setCurrentBeatmap(this.props.beatmap);
  };

  @action
  private onMouseEnter = () => {
    this.props.controller.hoveredBeatmap = this.props.beatmap;
  };

  @action
  private onMouseLeave = () => {
    this.props.controller.hoveredBeatmap = null;
  };
}
