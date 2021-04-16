// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import * as React from 'react';
import BeatmapSelection from './beatmap-selection';

interface Props {
  beatmaps: BeatmapJsonExtended[];
  currentBeatmap: BeatmapJsonExtended;
}

export default class BeatmapPicker extends React.PureComponent<Props> {
  render() {
    return (
      <div className='beatmapset-beatmap-picker'>
        {this.props.beatmaps.map((beatmap) => (
          <BeatmapSelection
            key={beatmap.id}
            active={this.props.currentBeatmap.id === beatmap.id}
            beatmap={beatmap}
          />
        ))}
      </div>
    );
  }
}
