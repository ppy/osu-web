// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import * as React from 'react';

interface Props {
  beatmap: BeatmapJsonExtended;
}

export default class Stats extends React.PureComponent<Props> {
  render() {
    const statsKey = this.getStatsKey();

    return (
      <div className='beatmapset-stats'>
        {statsKey.map((stat) => (
          <React.Fragment key={stat}>
            <div>{osu.trans(`beatmapsets.show.stats.${stat}`)}</div>
            <div className='beatmapset-stats__value'>
              {stat === 'difficulty_rating'
                ? osu.formatNumber(this.props.beatmap.difficulty_rating)
                : this.props.beatmap[stat]
              }
            </div>
            <div />
          </React.Fragment>
        ))}
      </div>
    );
  }

  private getStatsKey = (): (keyof BeatmapJsonExtended)[] => {
    switch (this.props.beatmap.mode) {
      case 'mania':
        return ['cs', 'drain', 'accuracy', 'difficulty_rating'];
      case 'taiko':
        return ['drain', 'accuracy', 'difficulty_rating'];
      default:
        return ['cs', 'drain', 'accuracy', 'ar', 'difficulty_rating'];
    }
  };
}
