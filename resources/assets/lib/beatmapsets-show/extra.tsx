// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import Controller from './controller';

interface Props {
  controller: Controller;
}

@observer
export default class Extra extends React.PureComponent<Props> {
  private get beatmap() {
    return this.props.controller.currentBeatmap;
  }

  private get beatmapset() {
    return this.props.controller.beatmapset;
  }

  @computed
  private get userRating() {
    return this.beatmapset.ratings.slice(1).reduce(
      (result, count, rating) => {
        result[rating < 5 ? 'negative' : 'positive'] += count;
        return result;
      },
      { negative: 0, positive: 0 },
    );
  }

  @computed
  private get successRate() {
    if (this.beatmap.playcount === 0) {
      return 0;
    }

    return (this.beatmap.passcount / this.beatmap.playcount) * 100;
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  render() {
    return (
      <div className='beatmapset-extra'>
        <div className='beatmapset-extra__item'>
          {osu.trans('beatmapsets.show.info.success-rate')}
        </div>
        <div className='beatmapset-extra__item beatmapset-extra__item--value beatmapset-extra__item--success-rate'>
          {formatNumber(this.successRate, 2)}%
        </div>
        <div className='beatmapset-extra__item beatmapset-extra__item--bar'>
          {this.renderBar(this.successRate)}
        </div>

        <div className='beatmapset-extra__item'>
          {osu.trans('beatmapsets.show.stats.user-rating')}
        </div>
        <div className='beatmapset-extra__item beatmapset-extra__item--value beatmapset-extra__item--user-rating'>
          <div>{this.userRating.negative}</div>
          <div>{this.userRating.positive}</div>
        </div>
        <div className='beatmapset-extra__item beatmapset-extra__item--bar'>
          {this.renderBar((this.userRating.positive * 100) / (this.userRating.positive + this.userRating.negative), true)}
        </div>

        {this.beatmapset.is_scoreable && (
          <>
            <div className='beatmapset-extra__item'>
              {osu.trans('beatmapsets.show.stats.rating-spread')}
            </div>
            <div className='beatmapset-extra__item beatmapset-extra__item--chart'>
              {this.renderChart(this.beatmapset.ratings.slice(1))}
            </div>
          </>
        )}
      </div>
    );
  }

  private renderBar(fill: number, rating = false) {
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
          '--bar-height': `${rating === 0 ? 0 : formatNumber((rating / maxRating) * 100, 2)}%`,
        } as React.CSSProperties}
      />
    ));
  }
}
