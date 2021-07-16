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

interface State {
  chartAreaBound: DOMRect | null;
}

export default class Extra extends React.PureComponent<Props, State> {
  private chartAreaRef = React.createRef<HTMLDivElement>();

  constructor(props: Props) {
    super(props);

    this.state = {
      chartAreaBound: null,
    };
  }


  componentDidMount() {
    this.setState({ chartAreaBound: this.chartAreaRef.current?.getBoundingClientRect() ?? null });
  }

  render() {
    const successRate = round((this.props.beatmap.passcount / this.props.beatmap.playcount) * 100, 1);
    const ratings = this.getRatings();

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
            <div ref={this.chartAreaRef} className='beatmapset-extra__item beatmapset-extra__item--chart'>
              {this.renderChart(this.props.beatmapset.ratings.slice(1))}
            </div>
          </>
        )}
      </div>
    );
  }

  renderBar(fill: number, fromRight = false) {
    return (
      <div className='beatmapset-bar beatmapset-bar--beatmapset-extra'>
        <div
          className={classWithModifiers('beatmapset-bar__fill', {
            right: fromRight,
          })}
          style={{ width: `${fill}%` }}
        />
      </div>
    );
  }

  renderChart(ratings: number[]) {
    const areaWidth = this.state.chartAreaBound?.width ?? 0;
    const areaHeight = this.state.chartAreaBound?.height ?? 0;

    const spacing = 2;
    const barCounts = ratings.length;
    const barWidth = (areaWidth - ((barCounts - 1) * spacing)) / barCounts;

    const maxRating = Math.max(...ratings);

    return (
      <svg height={areaHeight} width={areaWidth}>
        <defs>
          <clipPath id='bar-chart'>
            {ratings.map((rating, idx) => {
              const barHeight = (rating / maxRating) * areaHeight;

              return (
                <rect
                  key={`bar-${rating}-${idx}`}
                  height={barHeight}
                  rx={2}
                  width={barWidth}
                  x={idx * (barWidth + spacing)}
                  y={areaHeight - barHeight}
                />
              );
            })}
          </clipPath>
        </defs>
      </svg>
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
}
