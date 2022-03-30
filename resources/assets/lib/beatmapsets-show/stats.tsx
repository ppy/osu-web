// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import * as React from 'react';
import CountBadge from './count-badge';

interface Props {
  beatmap: BeatmapExtendedJson;
}

export default class Stats extends React.PureComponent<Props> {
  private get statsKey() {
    switch (this.props.beatmap.mode) {
      case 'mania':
        return ['cs', 'drain', 'accuracy', 'difficulty_rating'] as const;
      case 'taiko':
        return ['drain', 'accuracy', 'difficulty_rating'] as const;
      default:
        return ['cs', 'drain', 'accuracy', 'ar', 'difficulty_rating'] as const;
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

        {this.statsKey.map((key) => (
          <React.Fragment key={key}>
            {this.renderStat(key, this.props.beatmap[key])}
          </React.Fragment>
        ))}
      </div>
    );
  }

  private renderStat = (label: string, value: number) => {
    const addSpacer = label === 'accuracy';
    if (this.props.beatmap.mode === 'mania' && label === 'cs') {
      label += '-mania';
    }

    return (
      <>
        {addSpacer && <div className='beatmapset-stats__spacer' />}
        <div>{osu.trans(`beatmapsets.show.stats.${label}`)}</div>
        <div className='beatmapset-stats__value'>
          {osu.formatNumber(value)}
        </div>
        <div className='beatmapset-stats__bar'>
          <div className='bar bar--beatmap-stats'>
            <div
              className='bar__fill'
              style={{
                width: `${10 * Math.min(10, value)}%`,
              }}
            />
          </div>
        </div>
      </>
    );
  };
}
