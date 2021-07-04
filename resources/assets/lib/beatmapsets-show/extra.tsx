// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import { round } from 'lodash';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  beatmap: BeatmapJsonExtended;
  beatmapset: BeatmapsetExtendedJson;
}

export default class Extra extends React.PureComponent<Props> {
  render() {
    const successRate = round((this.props.beatmap.passcount / this.props.beatmap.playcount) * 100, 1);
    const ratings = this.props.beatmapset.ratings.reduce(
      (result, count, rating) => {
        if (rating >= 1 && rating <= 5) {
          result.negative += count;
        } else if (rating >= 6 && rating <= 10) {
          result.positive += count;
        }
        return result;
      },
      { negative: 0, positive: 0 },
    );

    return (
      <div className='beatmapset-extra'>
        <div className='beatmapset-extra__item'>
          {osu.trans('beatmapsets.show.info.success-rate')}
        </div>
        <div className='beatmapset-extra__item'>
          <div className='beatmapset-extra__right'>
            {`${successRate}%`}
          </div>
        </div>
        <div className='beatmapset-extra__item beatmapset-extra__item--bar'>
          {this.renderBar(successRate)}
        </div>

        <div className='beatmapset-extra__item'>
          {osu.trans('beatmapsets.show.stats.user-rating')}
        </div>
        <div className='beatmapset-extra__item beatmapset-extra__item--ratings'>
          <div>
            {ratings.negative}
          </div>
          <div className='beatmapset-extra__right'>
            {ratings.positive}
          </div>
        </div>
        <div className='beatmapset-extra__item beatmapset-extra__item--bar'>
          {this.renderBar((ratings.positive * 100) / (ratings.positive + ratings.negative), true)}
        </div>

        {this.props.beatmapset.is_scoreable && (
          <>
            <div className='beatmapset-extra__item'>
              {osu.trans('beatmapsets.show.stats.rating-spread')}
            </div>
            <div className='beatmapset-extra__item beatmapset-extra__item--chart'>
              {this.renderChart(this.props.beatmapset.ratings.slice(1))}
            </div>
          </>
        )}
      </div>
    );
  }

  renderBar(fill: number, fromRight = false) {
    return (
      <div className='beatmapset-extra__bar'>
        <div
          className={classWithModifiers('beatmapset-extra__bar', {
            fill: true,
            right: fromRight,
          })}
          style={{ width: `${fill}%` }}
        />
      </div>
    );
  }

  renderChart(ratings: number[]) {
    const max = Math.max(...ratings);

    return ratings.map((rating, idx) => (
      <div
        key={`${rating}-${idx}`}
        className='beatmapset-extra__chart'
        style={{ height: `${(rating / max) * 100}%` }}
      />
    ));
  }
}
