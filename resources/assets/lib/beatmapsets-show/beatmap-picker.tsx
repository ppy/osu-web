// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import * as React from 'react';
import BeatmapSelection from './beatmap-selection';
import Controller from './controller';

interface Props {
  controller: Controller;
}

@observer
export default class BeatmapPicker extends React.Component<Props> {
  private get beatmaps() {
    return this.props.controller.beatmaps.get(this.props.controller.currentBeatmap.mode) ?? [];
  }

  render() {
    return (
      <div className='beatmapset-beatmap-picker'>
        {this.beatmaps.map((beatmap) => (
          <BeatmapSelection
            key={beatmap.id}
            beatmap={beatmap}
            controller={this.props.controller}
          />
        ))}
      </div>
    );
  }
}
