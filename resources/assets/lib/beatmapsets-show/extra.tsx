// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  beatmap: BeatmapJsonExtended;
  beatmapset: BeatmapsetExtendedJson;
}

export default class Extra extends React.PureComponent<Props> {
  render() {
    const successRate = osu.formatNumber(this.props.beatmap.passcount === 0 ? 0 : (this.props.beatmap.passcount / this.props.beatmap.playcount) * 100, 2);
    const ratings = this.getRatings();

    return (
      <div className='beatmapset-extra'>
        <div className='beatmapset-extra__item'>
          {osu.trans('beatmapsets.show.info.success-rate')}
        </div>
        <div className='beatmapset-extra__item beatmapset-extra__item--value'>
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
        <div className='beatmapset-extra__item beatmapset-extra__item--value beatmapset-extra__item--ratings'>
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

  private getRatings = () => this.props.beatmapset.ratings.reduce(
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

  private renderBar(fill: number | string, rating = false) {
    return (
      <div className={classWithModifiers('bar', 'beatmapset-extra', { 'beatmapset-extra-rating': rating })}>
        <div
          className='bar__fill'
          style={{ width: `${fill}%` }}
        />
      </div>
    );
  }

  private renderChart(ratings: number[]) {
    const maxRating = Math.max(...ratings);

    return ratings.map((rating, idx) => (
      <div
        key={idx}
        className='beatmapset-extra__chart-bar'
        style={{
          '--background-position': `${idx * 10}%`,
          '--bar-height': `${rating === 0 ? 0 : osu.formatNumber((rating / maxRating) * 100, 2)}%`,
        } as React.CSSProperties}
      />
    ));
  }
}
