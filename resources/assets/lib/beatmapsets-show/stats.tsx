// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import * as React from 'react';
import { formatNumber } from 'utils/html';
import Controller from './controller';
import CountBadge from './count-badge';

interface Props {
  controller: Controller;
}

@observer
export default class Stats extends React.Component<Props> {
  private get statKeys() {
    switch (this.props.controller.currentBeatmap.mode) {
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
              circle_count: formatNumber(this.props.controller.currentBeatmap.count_circles),
              slider_count: formatNumber(this.props.controller.currentBeatmap.count_sliders),
            }}
          />
        </div>

        {this.statKeys.map(this.renderStat)}
      </div>
    );
  }

  private readonly renderStat = (key: typeof this.statKeys[number]) => {
    const rawValue = this.props.controller.currentBeatmap[key];
    let addSpacer = false;
    let label: string = key;
    let value: string;

    switch (key) {
      case 'accuracy':
        addSpacer = true;
        break;
      case 'difficulty_rating':
        label = 'stars';
        value = formatNumber(rawValue, 2);
        break;
      case 'cs':
        if (this.props.controller.currentBeatmap.mode === 'mania') {
          label += '-mania';
        }
        break;
    }

    value ??= formatNumber(rawValue);

    return (
      <React.Fragment key={key}>
        {addSpacer && <div className='beatmapset-stats__spacer' />}
        <div>{osu.trans(`beatmapsets.show.stats.${label}`)}</div>
        <div className='beatmapset-stats__value'>
          {value}
        </div>
        <div className='beatmapset-stats__bar'>
          <div className='bar bar--beatmap-stats'>
            <div
              className='bar__fill'
              style={{
                width: `${10 * Math.min(10, rawValue)}%`,
              }}
            />
          </div>
        </div>
      </React.Fragment>
    );
  };
}
