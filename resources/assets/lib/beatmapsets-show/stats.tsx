// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import * as React from 'react';
import { StringWithComponent } from 'string-with-component';

interface Props {
  beatmap: BeatmapJsonExtended;
}

export default class Stats extends React.PureComponent<Props> {
  render() {
    const statsKey = this.getStatsKey();

    return (
      <div className='beatmapset-stats'>
        <div className='beatmapset-stats__count'>
          <div>
            <StringWithComponent
              mappings={{
                ':count':
                  <span key='circles' className='beatmapset-stats__count-value'>
                    {this.props.beatmap.count_circles}
                  </span>,
              }}
              pattern={osu.trans('beatmapsets.show.details.circle_count')}
            />
          </div>

          <div>
            <StringWithComponent
              mappings={{
                ':count':
                  <span key='sliders' className='beatmapset-stats__count-value'>
                    {this.props.beatmap.count_sliders}
                  </span>,
              }}
              pattern={osu.trans('beatmapsets.show.details.slider_count')}
            />
          </div>
        </div>

        {statsKey.map(this.renderStat)}
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

  private renderStat = (stat: keyof BeatmapJsonExtended) => {
    if (this.props.beatmap.mode === 'mania' && stat === 'cs') {
      stat += '-mania';
    }

    return (
      <React.Fragment key={stat}>
        <div>{osu.trans(`beatmapsets.show.stats.${stat}`)}</div>
        <div className='beatmapset-stats__value'>
          {stat === 'difficulty_rating'
            ? osu.formatNumber(this.props.beatmap.difficulty_rating)
            : this.props.beatmap[stat]
          }
        </div>
        <div className='beatmapset-stats__bar-container'>
          <div className='beatmapset-bar'>
            <div
              className='beatmapset-bar__fill'
              style={{
                width: `${10 * Math.min(10, Number(this.props.beatmap[stat]))}%`,
              } as React.CSSProperties}
            />
          </div>
        </div>
      </React.Fragment>
    );
  };
}
