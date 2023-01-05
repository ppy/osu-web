// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { getDiffColourGroup } from 'utils/beatmap-helper';
import BeatmapSelection from './beatmap-selection';
import Controller from './controller';

interface Props {
  controller: Controller;
}

@observer
export default class BeatmapPicker extends React.Component<Props> {
  @computed
  private get groupedBeatmaps() {
    const grouped = new Map<string, Controller['currentBeatmaps']>();

    for (const beatmap of this.props.controller.currentBeatmaps) {
      const group = getDiffColourGroup(beatmap.difficulty_rating);
      let beatmaps = grouped.get(group);
      if (beatmaps == null) {
        beatmaps = [];
        grouped.set(group, beatmaps);
      }
      beatmaps.push(beatmap);
    }

    return grouped;
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  render() {
    return (
      <div className='beatmapset-beatmap-picker'>
        {[...this.groupedBeatmaps.entries()].map(([colour, beatmaps]) => (
          <div
            key={colour}
            className='beatmapset-beatmap-picker__group'
            style={{
              '--stripe-colour': colour,
            } as React.CSSProperties}
          >
            {beatmaps.map((beatmap) => (
              <BeatmapSelection
                key={beatmap.id}
                beatmap={beatmap}
                controller={this.props.controller}
              />
            ))}
          </div>
        ))}
      </div>
    );
  }
}
