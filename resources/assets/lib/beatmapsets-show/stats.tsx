// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import * as React from 'react';
import CountBadge from './count-badge';

interface Props {
  beatmap: BeatmapExtendedJson;
}

export default class Stats extends React.PureComponent<Props> {
  private get stastKey(): (keyof BeatmapExtendedJson)[] {
    switch (this.props.beatmap.mode) {
      case 'mania':
        return ['cs', 'drain', 'accuracy', 'difficulty_rating'];
      case 'taiko':
        return ['drain', 'accuracy', 'difficulty_rating'];
      default:
        return ['cs', 'drain', 'accuracy', 'ar', 'difficulty_rating'];
    }
  }

  render() {
    return (
      <div className='beatmapset-stats'>
        <div className='beatmapset-stats__count'>
          <CountBadge
            data={{
              circle_count: `${this.props.beatmap.count_circles}`,
              slider_count: `${this.props.beatmap.count_sliders}`,
            }}
          />
        </div>

        {this.stastKey.map(this.renderStat)}
      </div>
    );
  }

  private renderStat = (stat: keyof BeatmapExtendedJson) => {
    let label = stat;
    if (this.props.beatmap.mode === 'mania' && stat === 'cs') {
      label += '-mania';
    }

    return (
      <React.Fragment key={stat}>
        <div>{osu.trans(`beatmapsets.show.stats.${label}`)}</div>
        <div className='beatmapset-stats__value'>
          {stat === 'difficulty_rating'
            ? osu.formatNumber(this.props.beatmap.difficulty_rating)
            : this.props.beatmap[stat]
          }
        </div>
        <div className='beatmapset-stats__bar'>
          <div className='bar bar--beatmap-stats'>
            <div
              className='bar__fill'
              style={{
                width: `${10 * Math.min(10, Number(this.props.beatmap[stat]))}%`,
              }}
            />
          </div>
        </div>
      </React.Fragment>
    );
  };
}
