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
  render() {
    return (
      <div className='beatmapset-beatmap-picker'>
        {this.props.controller.currentBeatmaps.map((beatmap) => (
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
